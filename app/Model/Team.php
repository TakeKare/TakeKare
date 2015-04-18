<?php
class Team extends AppModel
{
    public $order = 'Team.title';

    public $belongsTo = [
        'Area',
        'Leader' => [
            'className' => 'User',
            'foreignKey' => 'leader_id'
        ]
    ];
}
