<?php
namespace Incidents\Controller;

use Cake\Event\Event;
use Cake\Network\Exception\InternalErrorException;
use Incidents\Controller\AppController;
use Users\Model\Entity\User;

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

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);

        if ($this->Auth->user('role') != User::ROLE_SUPER_ADMIN) {
            throw new InternalErrorException();
        }
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
