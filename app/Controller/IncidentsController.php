<?php
App::uses('BaseController', 'Controller');

class IncidentsController extends BaseController
{
    public function __construct($request = null, $response = null)
    {
        parent::__construct($request, $response);

        $this->setModel('Incident');
    }

    public function index()
    {
        $ages = Incident::ageList();
        $intoxications = Incident::intoxicationList();
        $receptivenesses = Incident::receptivenessList();
        $referrals = $this->Referral->find('list');
        $supportTypes = $this->SupportType->find('list', ['conditions' => ['SupportType.parent_id' => null]]);
        $supportTypeSubs = $this->SupportType->find('list', ['conditions' => ['NOT' => ['SupportType.parent_id' => null]]]);

        $this->set(compact('ages', 'intoxications', 'receptivenesses', 'referrals', 'supportTypes', 'supportTypeSubs'));

        parent::index();
    }

    public function save($itemId = null, $validate = true, $redirect = true, $cacheName = '')
    {
        $ages = Incident::ageList();
        $intoxications = Incident::intoxicationList();
        $receptivenesses = Incident::receptivenessList();
        $referrals = $this->Referral->find('list');
        $teams = $this->Team->find('list');
        $areas = $this->Area->find('list');
        $supportTypes = $this->SupportType->find('list', ['conditions' => ['SupportType.parent_id' => null]]);
        $supportTypeSubs = $this->SupportType->find('list', ['conditions' => ['NOT' => ['SupportType.parent_id' => null]]]);

        $this->set(compact('ages', 'intoxications', 'receptivenesses', 'referrals', 'supportTypes', 'supportTypeSubs', 'teams', 'areas'));

        parent::save($itemId, $validate, $redirect, $cacheName);
    }
}
