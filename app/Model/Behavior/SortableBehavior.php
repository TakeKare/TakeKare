<?php
App::import('Behavior', 'ModelBehavior');
class SortableBehavior extends ModelBehavior
{
    private $path       = '';
    private $href       = '';

    private $field      = null;
    private $dir        = '';
    private $groupBy    = false;
    private $extension  = 'jpg';

    public $settings   = array();

    public
    function setup(&$model, $settings)
    {
        $defaults = array(
            'field'     => 'pos',
            'group_by'  => null,
            'step'      => 10,
        );

        $this->settings[$model->name] = array_merge($defaults, $settings);

        $model->order["{$model->name}.{$this->settings[$model->name]['field']}"] = 'ASC';
    }

    public
    function beforeValidate(&$model)
    {
        if (isset($this->settings[$model->name]))
        {
            $s = $this->settings[$model->name];
            if (array_key_exists($s['field'], $model->data[$model->alias])
                    && !$model->data[$model->alias][$s['field']])
            {
                $conditions = array();
                if ($s['group_by'] && isset($model->data[$model->alias][$s['group_by']]))
                {
                    $conditions["{$model->alias}.{$s['group_by']}"] = $model->data[$model->alias][$s['group_by']];
                }

                $model->data[$model->alias][$s['field']] = $this->getNextPos($model, $conditions);
            }
        }

        return true;
    }

    public
    function getNextPos(&$model, $conditions = array())
    {
        if (!isset($this->settings[$model->name]))
            return false;

        $s = $this->settings[$model->name];

        $result = $model->find(
            'first',
            array(
                'fields'        => array("{$model->alias}.{$s['field']}"),
                'conditions'    => $conditions,
                'recursive'     => -1,
                'limit'         => 1,
                'order'         => array("{$model->alias}.{$s['field']}" => 'DESC')
            )
        );

        $result = $result
            ? floor($result[$model->alias][$s['field']] / $s['step']) * $s['step'] + $s['step']
            : $s['step'];

        return $result;
    }

    public
    function orderItem(&$model, $id, $direction)
    {
        if (!isset($this->settings[$model->name]))
            return false;

        $s = $this->settings[$model->name];

        $direction = $direction > 0
            ? '>'
            : '<';

        $conditions = compact('id');
        $recursive  = -1;
        $fields     = array('id', $s['field']);
        if ($s['group_by'])
        {
            $fields[] = $s['group_by'];
        }

        if (!$item1 = $model->find('first', compact('conditions', 'fields', 'recursive')))
            return false;

        $order      = array($s['field'] => $direction == '>' ? 'ASC' : 'DESC');
        $conditions = array("{$s['field']} {$direction}" => $item1[$model->alias][$s['field']]);
        if ($s['group_by'])
        {
            $conditions[$s['group_by']] = $item1[$model->alias][$s['group_by']];
        }

        if (!$item2 = $model->find('first', compact('conditions', 'fields', 'recursive', 'order')))
            return false;

        $data = array(
            $model->name => array(
                array(
                    'id'        => $item2[$model->alias]['id'],
                    $s['field'] => $item1[$model->alias][$s['field']],
                ),
            )

        );

        $data1 = array(
            'id'        => $item1[$model->alias]['id'],
            $s['field'] => $item2[$model->alias][$s['field']],
        );

        $data2 = array(
            'id'        => $item2[$model->alias]['id'],
            $s['field'] => $item1[$model->alias][$s['field']],
        );

        $model->begin();
        if (!$model->save($data1, false) || !$model->save($data2, false))
        {
            $model->rollback();
            return false;
        }

        $model->commit();
        return true;
    }
}
