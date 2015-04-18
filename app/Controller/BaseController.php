<?php
class BaseController extends AppController
{
    public $Model   = '';

    public $listUrl = array('action' => 'index');
    public $saveUrl = array('action' => 'save');
    public $toggleUrl = array('action' => 'toggle');
    public $orderUrl = array('action' => 'order');
    public $deleteUrl = array('action' => 'delete');
    public $deleteImageUrl  = array('action' => 'deleteImage');

    public $paginate = array('limit' => 20);

    public
    function beforeRender()
    {
        parent::beforeRender();

        $this->setVars();
    }

    public
    function index()
    {
        $this->Model->setFilters($this->passedArgs);

        $data = $this->paginate($this->Model->name, $this->Model->getFilters());

        $this->set(compact('data'));
    }

    public
    function save($itemId = null, $validate = true, $redirect = true, $cacheName = '')
    {
        $data = array();

        if (!empty($this->request->data) && array_key_exists($this->Model->name, $this->request->data))
        {
            if ($this->Model->saveAll($this->request->data, compact('validate')))
            {
                //if (!empty($cacheName))
                //{
                //    $this->Model->clearCache($cacheName);
                //}
                //$this->Model->clearCache($cacheName);

                $this->setFlash('entry successfuly saved');

                if ($redirect !== false)
                {
                    if (isset($this->request->data['return']))
                    {
                        $redirect = array($this->Model->id);
                    }

                    return $this->redirect($redirect === true
                        ? $this->listUrl
                        : $redirect
                    );
                }
                else
                {
                    return $this->Model->id;
                }
            }
        }

        if (is_id($itemId))
        {
            $data = $this->Model->findById($itemId);
        }

        if (empty($this->request->data) && !empty($data))
        {
            $this->request->data = $data;
        }

        $this->set(compact('data', 'itemId'));

        return false;
    }

    public
    function toggle($id, $field = 'visible')
    {
        $this->autoRender = false;

        $this->Model->id = $id;
        $visible = $this->Model->field($field);
        $this->Model->saveField($field, !$visible);

        if (!$this->request->is('ajax'))
        {
            return $this->redirect($this->referer());
        }
    }

    public
    function delete($id, $soft = false)
    {
        $this->autoRender = false;

        if ($soft)
        {
            $this->Model->id = $id;
            $this->Model->saveField('deleted', 1);
        }
        else
        {
            $this->Model->delete($id);
        }

        if (!$this->request->is('ajax'))
        {
            $this->setFlash('entry successfuly deleted');
            return $this->redirect($this->referer());
        }
    }

    public
    function deleteImage($id)
    {
        $this->autoRender = false;

        if (isset($this->Model->actsAs['ImageOwner']))
        {
            $this->Model->deleteImage($id);

            if (!$this->request->is('ajax'))
            {
                $this->setFlash('image successfuly deleted');
                return $this->redirect($this->referer());
            }
        }
        else
        {
            throw new NotFoundException();
        }
    }

    public
    function order($id, $direction)
    {
        $this->autoRender = false;

        if (isset($this->Model->actsAs['Sortable']))
        {
            $this->Model->orderItem($id, $direction);

            if (!$this->request->is('ajax'))
            {
                $this->setFlash('position changed successfuly');
                return $this->redirect($this->referer());
            }
        }
        else
        {
            throw new NotFoundException();
        }
    }

    protected
    function setVars()
    {
        $listUrl = $this->listUrl;
        $saveUrl = $this->saveUrl;
        $toggleUrl = $this->toggleUrl;
        $orderUrl = $this->orderUrl;
        $deleteUrl = $this->deleteUrl;
        $deleteImageUrl = $this->deleteImageUrl;
        $modelName = $this->Model->name;

        $this->set(compact('listUrl', 'saveUrl', 'toggleUrl', 'orderUrl', 'deleteUrl', 'deleteImageUrl', 'modelName'));
    }

    protected
    function setModel($modelName)
    {
        if (is_object($this->$modelName))
        {
            $this->Model = &$this->$modelName;
        }
        else
        {
            die(Lang::str('setting not an object'));
        }
    }

    protected
    function setFlash($message, $element = 'success')
    {
        $this->Session->setFlash($message, 'Flash'.DS.$element);
    }
}
