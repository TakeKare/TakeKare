<?php
namespace Incidents\Model\Entity;

use Cake\ORM\Entity;

/**
 * Team Entity.
 */
class Team extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'area_id' => true,
        'title' => true,
        'area' => true,
        'users' => true,
    ];
}
