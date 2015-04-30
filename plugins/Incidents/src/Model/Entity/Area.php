<?php
namespace Incidents\Model\Entity;

use Cake\ORM\Entity;

/**
 * Area Entity.
 */
class Area extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'city_id' => true,
        'title' => true,
        'city' => true,
        'incidents' => true,
        'teams' => true,
        'lat' => true,
        'lng' => true,
    ];
}
