<?php
App::uses('BaseController', 'Controller');

class DashboardsController extends AppController
{
    public function index()
    {
	$this->pageTitle = 'Saturday 18th April';
        $incidents = $this->Incident->find('all');
$this->set(compact('incidents'));
    }

}
