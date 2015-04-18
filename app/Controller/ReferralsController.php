<?php
App::uses('BaseController', 'Controller');

class ReferralsController extends BaseController
{
    public function __construct($request = null, $response = null)
    {
        parent::__construct($request, $response);

        $this->setModel('Referral');
    }
}
