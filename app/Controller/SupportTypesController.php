<?php
App::uses('BaseController', 'Controller');

class SupportTypesController extends BaseController
{
    public function __construct($request = null, $response = null)
    {
        parent::__construct($request, $response);

        $this->setModel('SupportType');
    }

    public function index()
    {
        $this->Model->setFilters($this->passedArgs);

        $conditions = $this->Model->getFilters();
        $conditions['parent_id'] = null;

        $data = $this->paginate($this->Model->name, $conditions);

        $this->set(compact('data'));
    }

    public function save($itemId = null, $validate = true, $redirect = true, $cacheName = '')
    {
        $parents = $this->SupportType->find('list', ['conditions' => ['parent_id' => null]]);
        if ($itemId) {
            unset($parents[$itemId]);
        }
        $this->set(compact('parents'));

        parent::save($itemId, $validate, $redirect, $cacheName);
    }
}
