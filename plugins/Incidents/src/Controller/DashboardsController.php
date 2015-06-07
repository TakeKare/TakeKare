<?php
namespace Incidents\Controller;

use Incidents\Controller\AppController;
use Incidents\Model\Entity\Incident;

/**
 * Teams Controller
 *
 * @property \Incidents\Model\Table\TeamsTable $Teams
 */
class DashboardsController extends AppController
{
    use IncidentsFilterTrait;

    public function live()
    {

    }

    public function report()
    {
        $this->loadModel('Incidents.Incidents');

        $where = $this->_getIncidentsFilter();

        $incidents = $this->Incidents
            ->find('all')
            ->contain(['Teams', 'Areas', 'Referrals', 'SupportTypes'])
            ->where($where);

        $ages = Incident::ageList();
        $intoxications = Incident::intoxicationList();
        $receptivenesses = Incident::receptivenessList();
        $referrals = $this->Incidents->Referrals->find('list')->order('pos');
        $supportTypes = $this->Incidents->SupportTypes
            ->find('list')
            ->where(['parent_id IS' => null])
            ->order('pos');
        $areas = $this->Incidents->Areas->getHierarchyList();
        $teams = $this->Incidents->Teams->find('list')->order('title');

        $this->set(compact('incidents', 'ages', 'intoxications', 'receptivenesses', 'referrals', 'supportTypes', 'areas', 'teams'));
    }
}
