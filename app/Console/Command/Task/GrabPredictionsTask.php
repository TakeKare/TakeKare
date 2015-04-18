<?php
App::uses('Market', 'Model');

class GrabPredictionsTask extends Shell
{
    public $uses = array('Predictor', 'Prediction', 'Match');

    public function execute($predictorId)
    {
        if (!$predictor = $this->Predictor->findById($predictorId))
            throw new NotFoundException("Predictor #{$predictorId} not found");

        $method = "grab{$predictor['Predictor']['title']}";

        if (!method_exists($this, $method))
            throw new NotFoundException("Grabbing method for predictor #{$predictorId} not found");

        $this->$method($predictor);
    }

    private function grabPickforwin($predictor)
    {
        $url = $predictor['Predictor']['url'];
        if (date('G') < 7)
            $url .= 'tomorrow-football-predictions.html';

        $html = get($url);

        $dom = new DomDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML($html);
        libxml_clear_errors();

        $xpath = new DOMXPath($dom);
        $rows = $xpath->query("//table[@rules='all']//tr");

        $day = $xpath->query("//div[@class='item-page']/h1")->item(0);
        $day = substr(trim($day->textContent), -10);

        $grabbed = 0;
        foreach ($rows as $k => $row) {
            $cols = $xpath->query(".//td", $row);
            if ($cols->length == 1 || $cols->item(0)->textContent == 'Time')
                continue;

            $time = trim($cols->item(0)->textContent);
            $date = date('Y-m-d H:i:s', strtotime("{$day} {$time} +0200"));

            $teams = explode(' - ', trim($cols->item(1)->textContent));
            $team1 = trim($teams[0]);
            $team2 = trim($teams[1]);

            if (!$match = $this->Match->findSimilar($team1, $team2, $date)) {
                $this->out("{$k}/{$rows->length} {$team1} vs {$team2} match not found. Skipping");
                continue;
            }

            if ($this->Prediction->findAllByPredictorIdAndMatchId($predictor['Predictor']['id'], $match['Match']['id'])) {
                $this->out("{$k}/{$rows->length} {$team1} vs {$team2} match predictions already saved. Skipping");
                continue;
            }

            $img = $xpath->query(".//img", $row);
            $img = ($img->length > 0)
                ? $img->item(0)->getAttribute('src')
                : '';

            $data = array(
                'predictor_id' => $predictor['Predictor']['id'],
                'match_id'     => $match['Match']['id'],
            );

            $predictions = [];

            $markets = array(
                Market::W1   => 2,
                Market::DRAW => 3,
                Market::W2   => 4,
                Market::U25  => 5,
                Market::O25  => 6,
            );

            foreach ($markets as $market => $col) {
                if (!$data['value'] = (float) $cols->item($col)->textContent)
                    continue;

                $data['market'] = $market;
                $data['is_recommended'] = (bool) ($img == "/images/{$market}.png");
                $predictions[] = $data;
            }

            $this->Prediction->saveAll($predictions);

            $grabbed++;
            $this->out("{$k}/{$rows->length} {$team1} vs {$team2} match predictions saved");
        }

        $this->out("{$grabbed} matches predictions grabbed. Finished!", 2);
    }

    private function grabScibet($predictor)
    {
        $html = get($predictor['Predictor']['url']);

        $dom = new DomDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML($html);
        libxml_clear_errors();

        $xpath = new DOMXPath($dom);
        $table = $xpath->query("//div[@class='canvas_body']//table");
        $table = $table->item(3);

        $grabbed = 0;
        $rows = $xpath->query("./tr", $table);
        foreach ($rows as $k => $row) {
            if ($xpath->query("./td", $row)->length != 9)
                continue;

            $date = trim($xpath->query("./td[@class='date']", $row)->item(0)->textContent);
            $date = explode('/', $date);
            $date = "{$date[1]}/{$date[0]}/{$date[2]}";

            $date = date('Y-m-d H:i:s', strtotime("{$date} +0100"));

            $team1 = trim($xpath->query("./td[@class='home']", $row)->item(0)->textContent);
            $team2 = trim($xpath->query("./td[@class='away']", $row)->item(0)->textContent);

            if (!$match = $this->Match->findSimilar($team1, $team2, $date)) {
                $this->out("{$k}/{$rows->length} {$team1} vs {$team2} match not found. Skipping");
                continue;
            }

            if ($this->Prediction->findAllByPredictorIdAndMatchId($predictor['Predictor']['id'], $match['Match']['id'])) {
                $this->out("{$k}/{$rows->length} {$team1} vs {$team2} match predictions already saved. Skipping");
                continue;
            }

            $resultsUrl = $predictor['Predictor']['url'] . trim($xpath->query("./td[@class='score']/a", $row)->item(0)->getAttribute('href'));
            $this->Match->id = $match['Match']['id'];
            $this->Match->saveField('results_url', $resultsUrl);

            $data = array(
                'predictor_id' => $predictor['Predictor']['id'],
                'match_id'     => $match['Match']['id'],
            );

            $probabilities = $xpath->query(".//table[@class='prob']", $row)->item(0)->getAttribute('title');
            $probabilities = explode('  ', trim($probabilities));
            if (count($probabilities) < 3)
                continue;

            $predictions = [];
            $markets = array(Market::W1, Market::DRAW, Market::W2);
            foreach ($markets as $k2 => $market) {
                $prob = $probabilities[$k2];
                $prob = substr($prob, 0, strlen($prob) - 2);
                $prob = substr($prob, 2);

                $data['value'] = (float) $prob;
                $data['market'] = $market;

                $predictions[] = $data;
            }

            if ($totals = $this->grabScibetTotals($resultsUrl, $data))
                $predictions = array_merge($predictions, $totals);

            $this->Prediction->saveAll($predictions);

            $grabbed++;
            $this->out("{$k}/{$rows->length} {$team1} vs {$team2} match predictions saved", 2);
        }

        $this->out("{$grabbed} matches predictions grabbed. Finished!", 2);
    }

    private function grabScibetTotals($url, $data)
    {
        $html = get($url);

        $dom = new DomDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML($html);
        libxml_clear_errors();

        $xpath = new DOMXPath($dom);
        $row = $xpath->query("//table[@id='books']//tr")->item(1);
        $cols = $xpath->query("./td", $row);

        $results = array();

        $data['value'] = (float) trim($cols->item(4)->textContent);
        $data['market'] = Market::U25;
        $results[] = $data;

        $data['value'] = (float) trim($cols->item(5)->textContent);
        $data['market'] = Market::O25;
        $results[] = $data;

        return $results;

        /*
        $xpath = new DOMXPath($dom);
        $table = $xpath->query("//div[@class='canvas_body']/table");
        $table = $table->item(2);

        if (trim($xpath->query(".//th", $table)->item(0)->textContent) != 'Mutual Matches')
            return array();

        if ($xpath->query("./tr", $table)->length < 6)
            return array();

        $scores = $xpath->query("./tr/td[@class='score']", $table);
        $over25 = 0;
        foreach ($scores as $score) {
            $goals = explode(' - ', trim($score->textContent));

            if ((int) $goals[0] + (int) $goals[1] > 2.5)
                $over25++;
        }

        $over25percent = round($over25 * 100 / $scores->length, 2);
        $under25percent = 100 - $over25percent;

        $results = array();

        $data['value'] = (float) $over25percent;
        $data['market'] = Market::O25;
        $results[] = $data;

        $data['value'] = (float) $under25percent;
        $data['market'] = Market::U25;
        $results[] = $data;

        return $results;

        */
    }
}