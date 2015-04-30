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

        $agesList = Incident::ageList();
        $intoxicationList = Incident::intoxicationList();

        $this->set(compact('agesList', 'intoxicationList'));

        $this->crudIndex();
    }

    public function save($id = null)
    {
        $ages = Incident::ageList();
        $intoxications = Incident::intoxicationList();

        $this->set(compact('ages', 'intoxications'));

        TableRegistry::get('SubSupportTypes', ['table' => 'support_types']);

        $this->crudSave($id);
    }
}
