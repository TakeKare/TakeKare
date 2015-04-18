<?php
App::uses('Market', 'Model');

class GrabRatesTask extends Shell
{
    public $uses = array('Bookmaker', 'BookmakerMatch', 'Match', 'Prediction', 'Rate');

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
        $conditions = array(
            'Match.date >' => date('Y-m-d H:i:s'),
            //'Match.is_visible' => true,
        );

        $matches = $this->Match->withBookmakerMatches()->find('all', compact('conditions'));

        $grabbed = 0;
        foreach ($matches as $k => $m) {
            foreach ($m['BookmakerMatch'] as $bm) {
                $conditions = array(
                    'match_id'     => $bm['match_id'],
                    'bookmaker_id' => $bm['bookmaker_id'],
                );

                $this->Rate->deleteAll($conditions);
                //if ($this->Rate->find('count', compact('conditions')))
                //    continue;

                $html = get(
                    $bm['url'],
                    'GET',
                    array(),
                    array(
                        CURLOPT_REFERER => $bookmaker['Bookmaker']['url']
                    )
                );

                $dom = new DomDocument();
                libxml_use_internal_errors(true);
                $dom->loadHTML($html);
                libxml_clear_errors();

                $xpath = new DOMXPath($dom);

                $scripts = $xpath->query("//script");
                $json = '';
                foreach ($scripts as $s) {
                    if (strpos($s->textContent, 'Delegator.init(') !== 0)
                        continue;

                    $json = str_replace('Delegator.init(', '', $s->textContent);
                    $json = substr($json, 0, -2);
                    $json = json_decode($json, true);
                }

                if (!$json || !dim($json['payload'][0]['rows']['Soccer']))
                    continue;

                $match = reset($json['payload'][0]['rows']['Soccer']);
                if (!$match = $match['Matches'][0])
                    continue;

                $rates = [];
                $rate = [
                    'match_id' => $bm['match_id'],
                    'bookmaker_id' => $bm['bookmaker_id']
                ];

                $rates[] = $rate + [
                        'market' => Market::W1,
                        'value'  => (float)$match['Competitors'][0]['Win']
                    ];

                $rates[] = $rate + [
                        'market' => Market::W2,
                        'value'  => (float)$match['Competitors'][1]['Win']
                    ];

                $rates[] = $rate + [
                        'market' => Market::DRAW,
                        'value'  => (float) $match['Draw']
                    ];

                /*
                if ($match['TotalOver'] == 2.5) {
                    $rates[] = $rate + [
                            'market' => Market::O25,
                            'value'  => (float) $match['OverDiv']
                        ];
                }

                if ($match['TotalUnder'] == 2.5) {
                    $rates[] = $rate + [
                            'market' => Market::U25,
                            'value'  => (float) $match['UnderDiv']
                        ];
                }
                */
                if ($goalMarkets = dim($match['AdditionalMarkets']['Goal Markets'])) {
                    foreach ($goalMarkets as $gm) {
                        if (strpos($gm['Description'], 'Over/Under 2.5') === false) {
                            continue;
                        }

                        if ($gm['TotalOptions'] != 2) {
                            continue;
                        }

                        $rates[] = $rate + [
                                'market' => Market::O25,
                                'value'  => (float) $gm['Options'][0]['Win']
                            ];

                        $rates[] = $rate + [
                                'market' => Market::U25,
                                'value'  => (float) $gm['Options'][1]['Win']
                            ];
                    }
                }

                $this->Rate->saveAll($rates);

                $grabbed++;
                $this->out("{$k}/" . count($matches) . " {$match['Description']} match rates saved");
            }
        }

        $this->out("{$grabbed} matches rates grabbed. Finished!", 2);
    }
}