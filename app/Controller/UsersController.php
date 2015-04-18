<?php
/**
 * @property User $User
 */

App::uses('BaseController', 'Controller');

class UsersController extends BaseController
{
    public $uses = array('User');

    public function __construct($request = null, $response = null)
    {
        parent::__construct($request, $response);

        $this->setModel('User');
    }

    public function index()
    {
        if (!$this->Auth->user('is_manager') && !$this->Auth->user('is_owner')) {
            throw new NotFoundException();
        }

        parent::index();
    }

    public function save($itemId = null, $validate = true, $redirect = true, $cacheName = '')
    {
        if (!empty($this->request->data) && array_key_exists($this->Model->name, $this->request->data)) {
            if (!$this->request->data['User']['password']) {
                unset($this->request->data['User']['password']);
            }
        }

        parent::save($itemId, $validate, $redirect, $cacheName);
    }

    public function beforeFilter()
    {
        parent::beforeFilter();

        $this->Auth->allow('login', 'register', 'reminder', 'pricing');
    }

    public function pricing()
    {
        $this->layout = 'ajax';
        $this->pageTitle = __('Please Sign In');

    }

    public function login()
    {
        $this->layout = 'login';
        $this->pageTitle = __('Please Sign In');

        if ($this->Auth->user())
            return $this->redirect($this->Auth->redirectUrl());

        if ($this->request->is('post'))
        {
            if ($this->Auth->login())
            {
                $this->User->logLogin($this->Auth->user('id'));

                $redirect = dim($this->request->data['User']['redirect'], $this->Auth->redirectUrl());
                return $this->redirect($redirect);
            }
            else
            {
                $this->User->invalidate('email', __('login error'));
            }
        }
    }

    public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }

    public function register()
    {
        $this->layout = 'login';
        $this->pageTitle = __('Register');

        if (!empty($this->request->data))
        {
            $this->User->loadEmailValidation();
            $this->User->loadPasswordValidation();

            $this->request->data['User']['hash'] = $this->User->getHash();

            $this->User->begin();
            if ($this->User->save($this->request->data, true, $this->User->fieldList['register']))
            {
                $this->request->data['User']['id'] = $this->User->id;
                if (!$this->Auth->login($this->request->data['User']))
                {
                    $this->User->rollback();
                    throw new InternalErrorException();
                }

                $this->User->commit();

                $this->User->logLogin($this->Auth->user('id'));

                $this->setFlash(__('registration successful'));

                $redirect = dim($this->request->data['User']['redirect'], array('action' => 'profile'));
                return $this->redirect($redirect);
            }
        }
    }

    public function profile()
    {
        if (!empty($this->request->data))
        {
            $fieldList = $this->User->fieldList['profile'];

            if ($this->request->data['User']['change_password'])
            {
                $this->User->loadPasswordValidation();
                $fieldList = array_merge($fieldList, $this->User->fieldList['change_password']);
            }

            $this->User->id = $this->Auth->user('id');
            if ($this->User->save($this->request->data, true, $fieldList))
            {
                $profile = $this->User->read();
                $this->Session->write('Auth.User', $profile['User']);

                $this->setFlash(__('profile saved successfuly'));
                return $this->redirect(array('action' => 'profile'));
            }
        }
        else
        {
            $this->request->data['User'] = $this->Auth->user();
            unset($this->request->data['User']['id']);
        }
    }

    public function reminder()
    {
        $this->layout = 'login';
        $this->pageTitle = __('Password change');

        if ($this->Auth->user())
            return $this->redirect($this->Auth->redirectUrl());

        if (!empty($this->request->data))
        {
            $this->User->loadEmailValidation(false);
            $this->User->set($this->request->data);
            if ($this->User->validates())
            {
                $email = $this->request->data['User']['email'];
                if ($user = $this->User->getPasswordReminder($email))
                {
                    $this->set(compact('user'));
                    $this->sendEmail($email, __('email subject password reminder'), 'reminder');

                    $this->setFlash(__('reminder sent successfuly'));
                    return $this->redirect(array('action' => 'reminder'));
                }
                else
                {
                    $this->User->invalidate('email', __('invalid email'));
                }
            }
        }
    }

    public function change_password($userId, $hash)
    {
        if (!$this->User->isValidHash($userId, $hash))
            throw new InternalErrorException();

        if (!empty($this->request->data))
        {
            $fieldList = array_merge($this->User->fieldList['change_password'], array('hash'));

            $this->User->loadPasswordValidation();
            $this->User->id = $userId;
            $this->request->data['User']['hash'] = $this->User->getHash();
            if ($this->User->save($this->request->data, true, $fieldList))
            {
                $this->setFlash(__('password changed successfully'));
                return $this->redirect(array('action' => 'login'));
            }
        }

        $this->set(compact('userId', 'hash'));
    }

    public function opauth_complete()
    {
        try {
            $user = $this->User->createOrUpdate($this->request->data);

            $this->Auth->login($this->User->toLoginArray($user));
            $this->User->logLogin($this->Auth->user('id'));

            $this->setFlash(__('Authenticated successfully'));
            return $this->redirect(array('controller' => 'index'));
        } catch (Exception $e) {
            //$this->Session->danger($e->getMessage());
            return $this->redirect(array('action' => 'login'));
        }
    }

}
