<?php
namespace Incidents\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Incidents\Model\Entity\SupportType;

/**
 * SupportTypes Model
 */
class SupportTypesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('support_types');
        $this->displayField('title');
        $this->primaryKey('id');
        $this->addBehavior('Timestamp');
        $this->hasMany('SubSupportTypes', [
            'className' => 'Incidents.SupportTypes',
            'foreignKey' => 'parent_id',
            'sort' => ['pos']
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
            ->requirePresence('title', 'create')
            ->notEmpty('title')
            ->requirePresence('icon', 'create')
            ->notEmpty('icon')
            ->add('pos', 'valid', ['rule' => 'numeric'])
            ->requirePresence('pos', 'create')
            ->notEmpty('pos');

        return $validator;
    }

}
