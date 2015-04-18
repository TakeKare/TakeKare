<?php

class UsersController extends ApiAppController
{


    public function collection()
    {
        if (!$this->request->is('post')) {
            throw new UnauthorizedException();
        }

        $this->request->data = [
            'User' => [
                'email'    => dim($this->request->query['email']),
                'password' => dim($this->request->query['password']),
            ]
        ];

        if (!$this->Auth->login()) {
            throw new UnauthorizedException();
        }

        $data = $this->Auth->user();

        $this->set($data);
        $this->set('_serialize', array_keys($data));
    }

    public function entity($id)
    {
        throw new NotFoundException();
    }
}
