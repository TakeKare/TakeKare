<?php
namespace Incidents\Controller;

use Incidents\Controller\AppController;

/**
 * Areas Controller
 *
 * @property \Incidents\Model\Table\AreasTable $Areas
 */
class AreasController extends AppController
{
    use \SimpleCRUD\Controller\SimpleCRUDTrait {
        index as crudIndex;
    }

    public function index()
    {
        $this->paginate = [
            'contain' => ['Cities']
        ];

        $this->crudIndex();
    }
}
