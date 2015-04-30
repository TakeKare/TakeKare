<?php
namespace Base\Controller;

use Base\Controller\AppController;
use Cake\Utility\Inflector;
use Bake\Utility\Model\AssociationFilter;
use Cake\ORM\TableRegistry;

/**
 * Base Controller
 *
 * @property \Base\Model\Table\BaseTable $Base
 */
class BaseController extends AppController
{
    public $Model;

    public $listUrl = ['action' => 'index'];
    public $saveUrl = ['action' => 'save'];
    public $toggleUrl = ['action' => 'toggle'];
    public $orderUrl = ['action' => 'order'];
    public $deleteUrl = ['action' => 'delete'];
    public $deleteImageUrl = ['action' => 'deleteImage'];

    protected $_associationFilter;

    public function initialize()
    {
        parent::initialize();

        $this->setModel($this->name);
    }

    protected function setModel($modelName)
    {
        $this->Model = $this->{$modelName};
    }

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $name = Inflector::variable($this->Model->alias());

        $this->set($name, $this->paginate($this->Model));
        $this->set('_serialize', [$name]);
    }

    public function save($id = null, $validate = true, $redirect = true)
    {
        $data = $id
            ? $this->Model->get($id)
            : $this->Model->newEntity();

        if ($this->request->is(['post', 'put', 'patch'])) {
            $data = $this->Model->patchEntity($data, $this->request->data);
            if ($this->Model->save($data)) {
                $this->Flash->success('The entry has been saved.');

                if ($redirect !== false) {
                    if (isset($this->request->data['return'])) {
                        $redirect = [$this->Model->id];
                    }

                    return $this->redirect($redirect === true ? $this->listUrl : $redirect);
                }
            } else {
                $this->Flash->error('The entry could not be saved. Please, try again.');
            }
        }

        $associations = $this->_filteredAssociations($this->Model);
        foreach ($associations as $assoc => $models) {
            foreach ($models as $k => $v) {
                $dataSet = TableRegistry::get($k);
                $this->set(Inflector::variable($k), $dataSet->find('list'));
            }
        }

        $name = Inflector::variable(Inflector::singularize($this->Model->alias()));
        $this->set($name, $data);
        $this->set(compact('id'));
        $this->set('_serialize', [$name]);
    }

    public function delete($id)
    {
        $this->autoRender = false;

        $this->request->allowMethod(['post', 'delete']);
        $incident = $this->Model->get($id);
        if ($this->Model->delete($incident)) {
            $this->Flash->success('The incident has been deleted.');
        } else {
            $this->Flash->error('The incident could not be deleted. Please, try again.');
        }

        if (!$this->request->is('ajax')) {
            return $this->redirect($this->referer());
        }
    }


    protected function _filteredAssociations($model)
    {
        if (is_null($this->_associationFilter)) {
            $this->_associationFilter = new AssociationFilter();
        }
        return $this->_associationFilter->filterAssociations($model);
    }
}
