<?php
namespace SimpleCRUD\Controller;

use Cake\Utility\Inflector;
use Bake\Utility\Model\AssociationFilter;
use Cake\ORM\TableRegistry;

trait SimpleCRUDTrait
{
    public $Model;

    public $listUrl = ['action' => 'index'];
    public $saveUrl = ['action' => 'save'];
    public $toggleUrl = ['action' => 'toggle'];
    public $orderUrl = ['action' => 'order'];
    public $deleteUrl = ['action' => 'delete'];
    public $deleteImageUrl = ['action' => 'deleteImage'];

    protected $_associationFilter;

    protected function setModel($model)
    {
        $this->Model = $model;
    }

    protected function getModel()
    {
        if (!$this->Model) {
            $this->Model = $this->{$this->name};
        }

        return $this->Model;
    }

    public function index()
    {
        $name = Inflector::variable($this->getModel()->alias());

        $this->set($name, $this->paginate($this->getModel()));
        $this->set('_serialize', [$name]);
    }

    public function save($id = null)
    {
        $data = $id
            ? $this->getModel()->get($id)
            : $this->getModel()->newEntity();

        if ($this->request->is(['post', 'put', 'patch'])) {
            $data = $this->getModel()->patchEntity($data, $this->request->data);
            if ($this->getModel()->save($data)) {
                $this->Flash->success('The entry has been saved.');

                if ($this->listUrl !== false) {
                    $this->redirect($this->listUrl);
                }
            } else {
                $this->Flash->error('The entry could not be saved. Please, try again.');
            }
        }

        $associations = $this->_filteredAssociations($this->getModel());
        foreach ($associations as $assoc => $models) {
            foreach ($models as $k => $v) {
                //$dataSet = TableRegistry::get($k);
                //$dataSet = $this->getModel()->{$k};
                $this->set(Inflector::variable($k), $dataSet->find('list'));
            }
        }

        $name = Inflector::variable(Inflector::singularize($this->getModel()->alias()));
        $this->set($name, $data);
        $this->set(compact('id'));
        $this->set('_serialize', [$name]);
    }

    public function delete($id)
    {
        $this->autoRender = false;

        $this->request->allowMethod(['post', 'delete']);
        $incident = $this->getModel()->get($id);
        if ($this->getModel()->delete($incident)) {
            $this->Flash->success('The incident has been deleted.');
        } else {
            $this->Flash->error('The incident could not be deleted. Please, try again.');
        }

        if (!$this->request->is('ajax')) {
            $this->redirect($this->referer());
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
