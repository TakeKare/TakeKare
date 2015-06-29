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
}
