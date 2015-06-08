<?php
namespace Incidents\Controller;

use Cake\Event\Event;
use Cake\Network\Exception\InternalErrorException;
use Incidents\Controller\AppController;
use Users\Model\Entity\User;

/**
 * Cities Controller
 *
 * @property \Incidents\Model\Table\CitiesTable $Cities
 */
class CitiesController extends AppController
{
    use \SimpleCRUD\Controller\SimpleCRUDTrait;

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);

        if ($this->Auth->user('role') != User::ROLE_SUPER_ADMIN) {
            throw new InternalErrorException();
        }
    }
}
