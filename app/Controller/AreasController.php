<?php
App::uses('BaseController', 'Controller');

class AreasController extends BaseController
{
    public function __construct($request = null, $response = null)
    {
        parent::__construct($request, $response);

        $this->setModel('Area');
    }

    public function save($itemId = null, $validate = true, $redirect = true, $cacheName = '')
    {
        $cities = $this->City->find('list');
        $this->set(compact('cities'));

        parent::save($itemId, $validate, $redirect, $cacheName);
    }
}
