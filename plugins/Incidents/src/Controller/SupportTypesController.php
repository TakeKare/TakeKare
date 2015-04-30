<?php
namespace Incidents\Controller;

use Incidents\Controller\AppController;

/**
 * SupportTypes Controller
 *
 * @property \Incidents\Model\Table\SupportTypesTable $SupportTypes
 */
class SupportTypesController extends AppController
{
    use \SimpleCRUD\Controller\SimpleCRUDTrait {
        index as crudIndex;
        save as crudSave;
    }

    public function index()
    {
        $this->paginate = [
            'contain' => ['SubSupportTypes'],
            'conditions' => ['parent_id IS' => null],
            'order' => ['SupportTypes.pos']
        ];

        $this->crudIndex();
    }

    public function save($id = null)
    {
        $parents = $this->SupportTypes->find('list', ['conditions' => ['parent_id IS' => null], 'order' => ['pos']]);

        $this->set(compact('parents'));

        $this->crudSave($id);
    }
}
