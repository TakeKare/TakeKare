<?php
namespace Incidents\Model\Entity;

use Cake\ORM\Entity;

/**
 * Referral Entity.
 */
class Referral extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'title' => true,
        'icon' => true,
        'color' => true,
        'pos' => true,
    ];
}
