<?php
namespace Users\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Users\Model\Entity\User;
use Cake\I18n\Time;

/**
 * Users Model
 */
class UsersTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('users');
        $this->displayField('name');
        $this->primaryKey('id');
        $this->addBehavior('Timestamp');
        $this->belongsTo('Teams', [
            'className' => 'Incidents.Teams'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->add('id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('id', 'create')
            ->requirePresence('name', 'create')
            ->notEmpty('name')
            ->add('email', 'valid', ['rule' => 'email'])
            ->requirePresence('email', 'create')
            ->notEmpty('email')
            ->requirePresence('role', 'create')
            ->notEmpty('role')
            ->add('is_active', 'valid', ['rule' => 'boolean'])
            ->requirePresence('is_active', 'create')
            ->add('role', 'inList', [
                'rule'    => ['inList', ['admin', 'author']],
                'message' => 'Please enter a valid role'
            ]);

        return $validator;
    }

    public function validationPassword(Validator $validator)
    {
        $validator
            ->requirePresence('password')
            ->add('password', 'valid', [
                'rule'    => ['custom', '/^[\w\d_\s]{7,255}$/'],
                'message' => 'Please enter valid password (min 7 characters)'
            ]);

        return $validator;
    }

    public function validationPasswordChange(Validator $validator)
    {
        $validator = $this->validationPassword($validator);

        $validator
            ->requirePresence('password_repeat')
            ->add('password', 'repeat', [
                'rule'    => function ($value, $context) {
                    return ($value == $context['data']['password_repeat']);
                },
                'message' => 'The passwords do not match'
            ]);

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['email']));
        $rules->add($rules->existsIn(['team_id'], 'Teams'));
        return $rules;
    }

    public function logLogin($id)
    {
        $user = $this->get($id);
        $user->last_login_date = new Time();
        $user->last_login_ip = $_SERVER['REMOTE_ADDR'];

        return $this->save($user);
    }
}
