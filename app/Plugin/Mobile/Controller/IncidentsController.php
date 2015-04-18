<?php

class IncidentsController extends MobileAppController
{

    public function __construct($request = null, $response = null)
    {
        parent::__construct($request, $response);

        $this->setModel('Incident');
    }

    public $layout = 'Mobile.mobile';

    public $uses = ['Incident'];

    public function index()
    {
        $incidents = $this->Incident->find('all');

        $referrals = $this->Referral->find('all');
        $supportTypes = $this->SupportType->find('all', ['conditions' => ['SupportType.parent_id' => null]]);

        $this->set(compact('incidents', 'referrals', 'supportTypes'));
    }


    public function save($itemId = null, $validate = true, $redirect = true, $cacheName = '')
    {
        $referrals = $this->Referral->find('all');
        $supportTypes = $this->SupportType->find('all', ['conditions' => ['SupportType.parent_id' => null]]);

        $this->set(compact('referrals', 'supportTypes'));

        parent::save($itemId, $validate, $redirect, $cacheName);
    }

}