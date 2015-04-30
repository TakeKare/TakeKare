<?php
namespace Incidents\Model\Table;

use Incidents\Model\Entity\Area;
use Cake\Database\Schema\Collection;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Areas Model
 */
class AreasTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('areas');
        $this->displayField('title');
        $this->primaryKey('id');
        $this->addBehavior('Timestamp');
        $this->belongsTo('Cities', [
            'className' => 'Incidents.Cities'
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
            ->notEmpty('title');

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
        $rules->add($rules->existsIn(['city_id'], 'Cities'));
        return $rules;
    }

    public function getHierarchyList()
    {
        $areas = $this->find('all');
        $cities = $this->Cities->find('list')->toArray();

        $result = [];
        foreach ($cities as $cityId => $cityTitle) {
            $result[$cityTitle] = $areas
                ->filter(function ($area, $key, $iterator) use ($cityId) {
                    return ($area->city_id == $cityId);
                })
                ->combine('id', 'title')
                ->toArray();
        }

        return $result;
    }
}
