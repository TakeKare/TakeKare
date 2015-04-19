<?php
App::uses('BaseController', 'Controller');

class DashboardsController extends AppController
{
    public function reports()
    {
	$this->pageTitle = 'Reporting';
        $incidents = $this->Incident->find('all');
$this->set(compact('incidents'));
    }

    public function index()
    {
	$this->pageTitle = 'Saturday 18th April';
        $incidents = $this->Incident->find('all');
$this->set(compact('incidents'));
    }

}
