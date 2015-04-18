<?php
class Area extends AppModel
{
    public $order = 'Area.title';

    public $belongsTo = array('City');
}
