<?php
class GrabShell extends AppShell
{
    public $tasks = array('GrabMatches', 'GrabPredictions', 'GrabRates', 'GrabResult');
    public $uses = array('Bookmaker', 'Predictor', 'Match');

    public function all()
    {
        set_time_limit(600);

        $grabTimeFile = LOGS . 'next_grab.txt';
        $grabTime = file_get_contents($grabTimeFile);

        if ($grabTime > date('Y-m-d H:i:s')) {
            $this->out("Not time yet. Next grab: {$grabTime}");
            return;
        }

        $this->matches();
        $this->predictions();
        $this->rates();

        $grabTime = date('Y-m-d H:i:s', time() + (rand(60, 120) * 60));
        $this->out("Grabbing finished. Next grab: {$grabTime}");
        file_put_contents($grabTimeFile, $grabTime);
    }

    public function matches()
    {
        $this->out("Starting matches grabbing...", 2);

        $bookmakers = $this->Bookmaker->find('all');

        foreach ($bookmakers as $bm) {
            $this->out("Grabbing {$bm['Bookmaker']['title']} matches...");
            $this->GrabMatches->execute($bm['Bookmaker']['id']);
        }

        $this->out("Matches grabbing finished!");
    }

    public function predictions()
    {
        $this->out("Starting matches grabbing...", 2);

        $predictors = $this->Predictor->find('all');

        foreach ($predictors as $p) {
            $this->out("Grabbing {$p['Predictor']['title']} predictions...");
            $this->GrabPredictions->execute($p['Predictor']['id']);
        }
        $this->out("Predictions grabbing finished!", 2);

        $this->out("Deleting matches without predictions...");
        $matches = $this->Match->findWithoutPrediction();
        $this->Match->deleteAll(array('id' => $matches));
        $this->out(count($matches) . " matches deleted!");
    }

    public function rates()
    {
        $this->out("Starting rates grabbing...", 2);

        $bookmakers = $this->Bookmaker->find('all');

        foreach ($bookmakers as $bm) {
            $this->out("Grabbing {$bm['Bookmaker']['title']} matches rates...");
            $this->GrabRates->execute($bm['Bookmaker']['id']);
        }

        $this->out("Rates grabbing finished!");
    }

    public function results()
    {
        $this->out("Starting results grabbing...", 2);

        $conditions = array(
            'date <'        => date('Y-m-d H:i:s', strtotime('-3 hours')),
            'results_saved' => false,
            'NOT'           => array('results_url' => ''),
        );
        $matches = $this->Match->find('all', compact('conditions'));

        foreach ($matches as $m) {
            $this->out("Grabbing {$m['Match']['team1']} vs {$m['Match']['team2']} matches results...");
            $this->GrabResult->execute($m['Match']['id']);
        }

        $this->out("Results grabbing finished!");
    }

}
