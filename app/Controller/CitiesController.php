<?php
App::uses('BaseController', 'Controller');

class CitiesController extends BaseController
{
    public function __construct($request = null, $response = null)
    {
        parent::__construct($request, $response);

        $this->setModel('City');
    }
}
