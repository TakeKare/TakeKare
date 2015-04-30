<?php
namespace Incidents\Controller;

use Incidents\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Teams Controller
 *
 * @property \Incidents\Model\Table\TeamsTable $Teams
 */
class TeamsController extends AppController
{
    use \SimpleCRUD\Controller\SimpleCRUDTrait {
        index as crudIndex;
        save as _crudSave;
    }

    public function index()
    {
        $this->paginate = [
            'contain' => ['Areas', 'Areas.Cities']
        ];

        $this->crudIndex();
    }

    public function save($id = null)
    {
        $areasList = TableRegistry::get('Incidents.Areas')->getHierarchyList();
        $this->set(compact('areasList'));

        $this->crudSave($id);
    }

}
