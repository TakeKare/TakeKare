<?php

class MobileController extends MobileAppController
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

    }

}
