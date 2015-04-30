<?php
namespace Incidents\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Incidents\Model\Entity\Incident;

/**
 * Incidents Model
 */
class IncidentsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('incidents');
        $this->displayField('id');
        $this->primaryKey('id');
        $this->addBehavior('Timestamp');
        $this->belongsTo('Areas', [
            'foreignKey' => 'area_id',
            'joinType' => 'INNER',
            'className' => 'Incidents.Areas'
        ]);
        $this->belongsTo('Teams', [
            'foreignKey' => 'team_id',
            'joinType' => 'INNER',
            'className' => 'Incidents.Teams'
        ]);
        $this->belongsTo('Referrals', [
            'foreignKey' => 'referral_id',
            'className' => 'Incidents.Referrals'
        ]);
        $this->belongsTo('SupportTypes', [
            'foreignKey' => 'support_type_id',
            'className' => 'Incidents.SupportTypes'
        ]);
        $this->belongsTo('SubSupportTypes', [
            'foreignKey' => 'sub_support_type_id',
            'className' => 'Incidents.SubSupportTypes'
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
            ->add('males_number', 'valid', ['rule' => 'numeric'])
            ->requirePresence('males_number', 'create')
            ->notEmpty('males_number')
            ->add('females_number', 'valid', ['rule' => 'numeric'])
            ->requirePresence('females_number', 'create')
            ->notEmpty('females_number')
            ->add('age', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('age')
            ->add('intoxication', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('intoxication')
            ->add('receptiveness', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('receptiveness')
            ->requirePresence('referral_comment', 'create')
            ->notEmpty('referral_comment')
            ->requirePresence('comment', 'create')
            ->notEmpty('comment')
            ->add('lat', 'valid', ['rule' => 'decimal'])
            ->allowEmpty('lat')
            ->add('lng', 'valid', ['rule' => 'decimal'])
            ->allowEmpty('lng')
            ->add('draft', 'valid', ['rule' => 'boolean'])
            ->requirePresence('draft', 'create')
            ->notEmpty('draft')
            ->add('police', 'valid', ['rule' => 'boolean'])
            ->requirePresence('police', 'create')
            ->notEmpty('police')
            ->add('contact', 'valid', ['rule' => 'boolean'])
            ->requirePresence('contact', 'create')
            ->notEmpty('contact')
            ->add('report', 'valid', ['rule' => 'boolean'])
            ->requirePresence('report', 'create')
            ->notEmpty('report')
            ->add('water_given', 'valid', ['rule' => 'numeric'])
            ->requirePresence('water_given', 'create')
            ->notEmpty('water_given')
            ->add('chupa_chups_given', 'valid', ['rule' => 'numeric'])
            ->requirePresence('chupa_chups_given', 'create')
            ->notEmpty('chupa_chups_given')
            ->add('thongs_given', 'valid', ['rule' => 'numeric'])
            ->requirePresence('thongs_given', 'create')
            ->notEmpty('thongs_given')
            ->add('vomit_bags_given', 'valid', ['rule' => 'numeric'])
            ->requirePresence('vomit_bags_given', 'create')
            ->notEmpty('vomit_bags_given');

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
        $rules->add($rules->existsIn(['area_id'], 'Areas'));
        $rules->add($rules->existsIn(['team_id'], 'Teams'));
        $rules->add($rules->existsIn(['referral_id'], 'Referrals'));
        $rules->add($rules->existsIn(['support_type_id'], 'SupportTypes'));
        $rules->add($rules->existsIn(['sub_support_type_id'], 'SubSupportTypes'));
        return $rules;
    }
}
