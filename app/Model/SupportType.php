<?php

//App::uses('SortableBehavior', 'ModelBehavior');

//App::import('Sortable', 'ModelBehavior');

class SupportType extends AppModel
{
    public $order = 'SupportType.pos';

    public $hasMany = array(
        'SubSupportType' => array(
            'className'  => 'SupportType',
            'foreignKey' => 'parent_id',
            'order'      => 'SubSupportType.pos',
        )
    );

}
