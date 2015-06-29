<?php
namespace Incidents\Controller;

use Cake\Event\Event;
use Cake\Network\Exception\InternalErrorException;
use Incidents\Controller\AppController;
use Users\Model\Entity\User;

/**
 * Areas Controller
 *
 * @property \Incidents\Model\Table\AreasTable $Areas
 */
class AreasController extends AppController
{
    use \SimpleCRUD\Controller\SimpleCRUDTrait;
}
