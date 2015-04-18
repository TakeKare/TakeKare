<?php
App::uses('Model', 'Model');

class AppModel extends Model
{

    public function beforeSave($options = array())
    {
        if ($this->hasField('user_id')) {
            $this->data[$this->alias]['user_id'] = AuthComponent::user('id');
        }

        if ($this->hasField('company_id')) {
            $this->data[$this->alias]['company_id'] = AuthComponent::user('Branch.company_id');
        }

        return parent::beforeSave($options);
    }

    public function beforeFind($queryData)
    {
        parent::beforeFind($queryData);

        if ($this->hasField('user_id'))
            //&& !in_array($this->name, array('User', 'EventReg'))
            //&& !isset($queryData['conditions']["{$this->alias}.lang"]))
        {
            $queryData['conditions'] = array_merge(
                dim($queryData['conditions'], array()),
                array("{$this->alias}.user_id" => AuthComponent::user('id'))
            );
        }

        if ($this->hasField('company_id'))
        {
            $queryData['conditions'] = array_merge(
                dim($queryData['conditions'], array()),
                array("{$this->alias}.company_id" => AuthComponent::user('Branch.company_id'))
            );
        }

        return $queryData;
    }

    public function isEqual($value, $params)
    {
        $var = key($value);

        $compareTo = isset($params['parameters']['compareField'])
            ? $this->data[$this->name][$params['parameters']['compareField']]
            : $this->data[$this->name]['password'];

        if (isset($this->data[$this->name][$var])) {
            if ($this->data[$this->name][$var] != $compareTo)
                return false;
        }

        return true;
    }

    public function setFilters($params) {
        foreach ($params as $k => $v) {
            if ($this->hasField($k) && !empty($v)) {
                //if (in_array($this->getColumnType($k), array('string', 'text')))
                //{
                //    $this->filters["{$this->alias}.{$k} LIKE"] = "%{$v}%";
                //}
                //else
                {
                    $this->filters["{$this->alias}.{$k}"] = $v;
                }
            }
        }

        //$this->data['Filter'] = $params;

        return $this->filters;
    }

    public function getFilters()
    {
        return $this->filters;
    }

}
