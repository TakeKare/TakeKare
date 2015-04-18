<?php
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class User extends AppModel
{

    public $displayFields = array('id', 'name');

    public $fieldList = array(
        'register'        => array('email', 'password', 'password_repeat', 'hash' /*, 'send_promos'*/, 'registered', 'hash_permanent'),
        'profile'         => array( /*'id', 'send_promos'*/),
        'change_password' => array('password', 'password_repeat', 'hash'),
    );

    public function loadEmailValidation($uniqueCheck = true)
    {
        $this->validate = array_merge_recursive($this->validate, array(
            'email' => array(
                'notEmpty' => array(
                    'rule'          => 'email',
                    'message'       => 'need enter email',
                    'required'      => true,
                    'allowEmpty'    => false
                ),
            ),
        ));

        if ($uniqueCheck)
        {
            $this->validate = array_merge_recursive($this->validate, array(
                'email' => array(
                    'isUnique'  => array(
                        'rule'          => array('isUnique', array()),
                        'message'       => 'need enter unique email',
                    ),
                ),
            ));
        }
    }

    public function loadPasswordValidation()
    {
        $this->validate = array_merge_recursive($this->validate, array(
            'password'  => array(
                'required' => array(
                    'rule'          => 'notEmpty',
                    'message'       => 'need enter password',
                    'required'      => true,
                    'allowEmpty'    => false,
                ),
                'validpass' => array(
                    'rule'          => '/^[\w\d_\s]{7,255}$/',
                    'message'       => 'need enter valid password',
                    'required'      => true,
                    'allowEmpty'    => false,
                ),
            ),
            'password_repeat'   => array(
                'required'  => array(
                    'rule'          => 'notEmpty',
                    'message'       => 'need enter password_repeat',
                    'required'      => true,
                    'allowEmpty'    => false,
                ),
                'isEqual'   => array(
                    'rule'          => 'isEqual',
                    'message'       => 'need repeat password',
                    'parameters'    => array(
                        'compareField'  => 'password',
                    ),
                    'required'      => true,
                    'allowEmpty'    => false,
                ),
            ),
        ));
    }

    public function beforeSave($options = array())
    {
        if (!empty($this->data[$this->alias]['password'])) {
            $passwordHasher = new SimplePasswordHasher(array('hashType' => 'sha256'));
            $this->data[$this->alias]['password'] = $passwordHasher->hash(
                $this->data[$this->alias]['password']
            );
        }

        $this->data[$this->alias]['hash'] = $this->getHash();

        return parent::beforeSave($options);
    }

    public function getPasswordReminder($email)
    {
        return $this->find(
            'first',
            array(
                'conditions'    => compact('email'),
                'fields'        => array('id', 'email', 'hash'),
                'recursive'     => -1
            )
        );
    }

    public function isValidHash($id, $hash)
    {
        return $this->find('count', array('conditions' => compact('id', 'hash')));
    }

    public function getHash()
    {
        return sha1(date('Y-m-d H:i:s'));
    }

    public function logLogin($id)
    {
        $this->id = $id;
        return $this->save(
            array(
                'last_login_date' => date('Y-m-d H:i:s'),
                'last_login_ip'   => $_SERVER['REMOTE_ADDR'],
            ),
            false
        );
    }

    public function isUnique($value, $conditions = array())
    {
        $field = key($value);
        $value = reset($value);

        //$conditions['NOT']["{$this->alias}.id"] = $this->id;
        //$conditions['NOT']["{$this->alias}.registered"] = null;
        $conditions[$field] = $value;

        return !$this->hasAny($conditions);
    }

    public function createOrUpdate($data)
    {
        if (empty($data['auth']['credentials']['token']))
            throw new Exception('Missing oauth token');

        if (empty($data['validated']))
            throw new Exception('Invalid oauth login');

        $conditions = array(
            'Identity.uid'      => $data['auth']['uid'],
            'Identity.provider' => $data['auth']['provider'],
        );

        if (!$user = $this->find('first', compact('conditions'))) {
            $user = array(
                'User'     => array(
                    'id'             => null,
                    'hash_permanent' => $this->getHash()
                ),
                'Identity' => array(
                    'uid'      => $data['auth']['uid'],
                    'provider' => $data['auth']['provider'],
                ),
            );
        }

        $user['Identity']['name'] = (string)$data['auth']['info']['name'];
        $user['Identity']['nickname'] = (string)$data['auth']['info']['nickname'];
        $user['Identity']['image'] = (string)$data['auth']['info']['image'];
        $user['Identity']['email'] = (string)$data['auth']['info']['email'];
        $user['Identity']['token'] = serialize($data['auth']['credentials']);

        $this->saveAssociated($user);

        $user['User']['id'] = $this->id;

        return $user;
    }

    public function toLoginArray($user)
    {
        $result = $user['User'];
        $result['Account'] = $user['Account'];
        //$result['Identity'] = $user['Identity'];

        return $result;
    }
}
