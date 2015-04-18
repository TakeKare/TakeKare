<?php
App::uses('BaseController', 'Controller');

class TeamsController extends BaseController
{
    public function __construct($request = null, $response = null)
    {
        parent::__construct($request, $response);

        $this->setModel('Team');
    }

    public function save($itemId = null, $validate = true, $redirect = true, $cacheName = '')
    {
        $areas = $this->Area->find('list');
        $leaders = [];
        if ($itemId) {
            $leaders = $this->User->find('list', ['conditions' => ['team_id' => $itemId]]);
        }
        $this->set(compact('areas', 'leaders'));

        parent::save($itemId, $validate, $redirect, $cacheName);
    }
}
