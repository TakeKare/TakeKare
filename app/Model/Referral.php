<?php

//App::uses('SortableBehavior', 'ModelBehavior');

//App::import('Sortable', 'ModelBehavior');

class Referral extends AppModel
{
    public $order = 'Referral.pos';

    public $actsAs = array(
        //'Sortable'
    );

}
