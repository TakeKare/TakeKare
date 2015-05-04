<?php
namespace Incidents\Controller;

use Incidents\Controller\AppController;
use Incidents\Model\Entity\Incident;
use Cake\ORM\TableRegistry;

/**
 * Incidents Controller
 *
 * @property \Incidents\Model\Table\IncidentsTable $Incidents
 */
class IncidentsController extends AppController
{
    use \SimpleCRUD\Controller\SimpleCRUDTrait {
        index as crudIndex;
        save as crudSave;
    }

    public function index()
    {
        $this->paginate = [
            'contain' => ['Teams', 'Areas', 'Areas.Cities', 'SubSupportTypes']
        ];

        $ages = Incident::ageList();
        $intoxications = Incident::intoxicationList();
        $receptivenesses = Incident::receptivenessList();

        $this->set(compact('ages', 'intoxications', 'receptivenesses'));

        $this->crudIndex();
    }

    public function save($id = null)
    {
        $ages = Incident::ageList();
        $intoxications = Incident::intoxicationList();
        $areas = $this->Incidents->Areas->getHierarchyList();
        $receptivenesses = Incident::receptivenessList();

        $subSupportTypesFull = $this->Incidents->SubSupportTypes
            ->find('all')
            ->where(['parent_id IS NOT' => null])
            ->order('pos');

        //debug($subSupportTypes->toArray());

        $this->crudSave($id);


        $this->set(compact('ages', 'intoxications', 'subSupportTypesFull', 'areas', 'receptivenesses'));

    }
}
