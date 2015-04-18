<?php

App::uses('AppController', 'Controller');

class ApiAppController extends AppController {

    public $components = array('RequestHandler', 'Paginator', 'Auth', 'Session');
    public $uses = array('Products');

    public function beforeFilter()
    {
        $this->_setAuth();

        if ($this->request->params['controller'] == 'users' && $this->request->params['action'] == 'collection') {
            return;
        }

        $query = $this->request->query;
        //$query['id'] = 1;

        //if (!$user = $this->User->findByIdAndToken($query['user_id'], $query['token'])) {
        if (!$user = $this->User->findById($query['id'])) {
            throw new UnauthorizedException();
        }

        $user['User']['Branch'] = $user['Branch'];

        $this->Auth->login($user['User']);
    }

    public function collection()
    {
        $modelName = Inflector::singularize($this->name);
        $model = $this->$modelName;
        $data = [];

        if ($this->request->is('post')) {
            $data = $this->request->data;
            if (!$model->saveAll($data)) {
                throw new NotFoundException('Error');
            }
        } elseif ($this->request->is('get')) {
            $data = $this->Paginator->paginate($model);
        }

        //$this->set(compact('data'));
        //$this->set('_serialize', ['data']);

        $this->set($data);
        $this->set('_serialize', array_keys($data));
    }

    public function entity($id)
    {
        $modelName = Inflector::singularize($this->name);
        $model = $this->$modelName;

        if (!$data = $model->findById($id)) {
            throw new NotFoundException();
        }

        $data = $data[$modelName];

        $model->id = $id;

        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->data;
            if (!$model->save($data)) {
                throw new NotFoundException('Update failed');
            }
        } elseif ($this->request->is(['delete'])) {
            if (!$model->delete($id)) {
                throw new NotFoundException('Delete failed');
            }
        }

        //$this->set(compact('data'));
        //$this->set('_serialize', ['data']);

        $this->set($data);
        $this->set('_serialize', array_keys($data));
    }

    private function _setAuth()
    {
        $this->Auth->authenticate = array(
            'Form' => array(
                'userModel' => 'User',
                'fields'         => array(
                    'username' => 'email',
                    'password' => 'password'
                ),
                'scope'          => array(
                    //'NOT'       => array('registered' => null),
                    'is_active' => 1
                ),
                'passwordHasher' => array(
                    'className' => 'Simple',
                    'hashType'  => 'sha256'
                ),
            )
        );

        $this->Auth->allow();

        $this->set('userInfo', $this->Auth->user());
    }

}
