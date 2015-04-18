<?php
class GrabMatchesTask extends Shell
{
    public $uses = array('Bookmaker', 'BookmakerMatch', 'Match');

    public function execute($bookmakerId)
    {
        if (!$bookmaker = $this->Bookmaker->findById($bookmakerId))
            throw new NotFoundException("Bookmaker #{$bookmakerId} not found");

        $method = "grab{$bookmaker['Bookmaker']['title']}";

        if (!method_exists($this, $method))
            throw new NotFoundException("Grabbing method for bookmaker #{$bookmakerId} not found");

        $this->$method($bookmaker);
    }

    private function grabLadbrokes($bookmaker)
    {
        $html = get($bookmaker['Bookmaker']['url']);

        $dom = new DomDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML($html);
        libxml_clear_errors();

        $xpath = new DOMXPath($dom);
        $rows = $xpath->query("//table[@class='market-table matches match-listings']//a[@class='match-listing']");

        $grabbed = 0;
        foreach ($rows as $k => $row) {
            $teams = trim($xpath->query(".//span[@class='match-team']", $row)->item(0)->textContent);
            $date = $row->getAttribute('title');
            $url = 'https://www.ladbrokes.com.au' . $row->getAttribute('href');

            $teams = explode(' vs ', $teams);
            $team1 = trim($teams[0]);
            $team2 = trim($teams[1]);

            $date = date('Y-m-d H:i:s', strtotime($date));

            if ($date > date('Y-m-d H:i:s', strtotime('+3 days'))) {
                $this->out("{$k}/{$rows->length} {$team1} vs {$team2} at {$date}. Skipping: too far away");
                continue;
            }

            if ($this->Match->withBookmakerMatch($bookmaker['Bookmaker']['id'])->findByTeam1AndTeam2AndDate($team1, $team2, $date)) {
                $this->out("{$k}/{$rows->length} {$team1} vs {$team2} at {$date}. Skipping Already saved");
                continue;
            }

            $this->Match->create();
            $this->Match->save(compact('team1', 'team2', 'date'));

            $this->BookmakerMatch->create();
            $this->BookmakerMatch->save(
                array(
                    'bookmaker_id' => $bookmaker['Bookmaker']['id'],
                    'match_id'     => $this->Match->id,
                    'url'          => $url,
                )
            );

            $grabbed++;
            $this->out("{$k}/{$rows->length} {$team1} vs {$team2} at {$date}");
        }

        $this->out("{$grabbed} matches grabbed. Finished!", 2);
    }
}