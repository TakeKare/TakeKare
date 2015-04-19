<?php
App::uses('BaseController', 'Controller');

class DashboardsController extends AppController
{
    public function reports()
    {
        $this->pageTitle = 'Reporting';

        $incidents = $this->Incident->find('all');

        $countWater = 0;
        $countThongs = 0;
        $countChupaChups = 0;
        $countVomitBags = 0;
        foreach ($incidents as $i) {
            $countWater += $i['Incident']['water_given'];
            $countThongs += $i['Incident']['thongs_given'];
            $countChupaChups += $i['Incident']['chupa_chups_given'];
            $countVomitBags += $i['Incident']['vomit_bags_given'];

        }

        $this->set(compact('incidents', 'countWater', 'countThongs', 'countChupaChups', 'countVomitBags'));
    }

    public function index()
    {
        $this->pageTitle = 'Saturday 18th April';

        $incidents = $this->Incident->find('all');

        $countTotal = count($incidents);

        $countPeople = 0;
        $countFirstAid = 0;
        $countProfessionals = 0;
        foreach ($incidents as $i) {
            $countPeople += $i['Incident']['males_number'];
            $countPeople += $i['Incident']['females_number'];

            if ($i['Incident']['support_type_id'] == 9) {
                $countFirstAid++;
            } elseif ($i['Incident']['support_type_id'] == 10) {
                $countProfessionals++;
            }
        }

        $this->set(compact('incidents', 'countTotal', 'countPeople', 'countFirstAid', 'countProfessionals'));
    }

}
