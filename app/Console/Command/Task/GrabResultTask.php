<?php
class GrabResultTask extends Shell
{
    public $uses = array('Match', 'Prediction');

    public function execute($matchId)
    {
        if (!$match = $this->Match->findById($matchId))
            throw new NotFoundException("Match #{$matchId} not found");

        $html = get($match['Match']['results_url']);

        $dom = new DomDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML($html);
        libxml_clear_errors();

        $xpath = new DOMXPath($dom);

        $goals = trim($xpath->query("//div[@class='canvas_body']/table/tr/td[@class='score']")->item(0)->textContent);
        $goals = explode(' - ', $goals);

        $data = array(
            'results_saved' => true,
            'goals1' => (int) $goals[0],
            'goals2' => (int) $goals[1],
        );

        $this->Match->id = $matchId;
        $this->Match->save($data);

        $this->out("Match score {$goals[0]} - {$goals[1]}", 2);
    }

}