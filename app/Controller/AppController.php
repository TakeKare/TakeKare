<?php
App::uses('Controller', 'Controller');

class AppController extends Controller
{
    public $helpers = array(
        'Session',
        'Form' => array('className' => 'CakeStrap.CakeStrapForm'),
        'Html',
        'Number',
        'Time',
        //'GoogleMap',
    );

    public $components = array(
        'Session',
        'Paginator',
        'RequestHandler',
        //'DebugKit.Toolbar',
        'Auth',
    );

    public $theme;
    public $params;

    public $pageTitle   = '';

    private function _setAuth()
    {
        $this->Auth->authenticate  = array(
            'Form' => array(
                'userModel'      => 'User',
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
                'allow'          => array('login'),
                'loginAction'    => array('controller' => 'users', 'action' => 'login', 'plugin' => false),
                'loginRedirect'  => array('controller' => 'users', 'action' => 'index', 'plugin' => false),
                'logoutRedirect' => array('controller' => 'users', 'action' => 'index', 'plugin' => false),
            )
        );

        $this->Auth->loginAction = array(
            'controller' => 'users',
            'action'     => 'login',
            'plugin'     => false
        );

        $this->Auth->logoutRedirect = array(
            'controller' => 'users',
            'action'     => 'login',
            'plugin'     => false
        );

        $this->Auth->deny();

        $this->set('userInfo', $this->Auth->user());
    }

    public function __get($name)
    {
        if ($obj = ClassRegistry::init($name))
            return $this->{$name} = $obj;

        return false;
    }

    public function beforeFilter()
    {
        $this->_setAuth();

        parent::beforeFilter();
    }

    public function beforeRender()
    {
        $this->set('pageTitle', $this->pageTitle);

        parent::beforeRender();
    }

    public function redirect($url, $status = null, $exit = true)
    {
        parent::redirect($url, $status, $exit);

        return true;
    }

    protected function setFlash($message, $element = 'success')
    {
        $this->Session->setFlash($message, 'Flash' . DS . $element);
    }

}
