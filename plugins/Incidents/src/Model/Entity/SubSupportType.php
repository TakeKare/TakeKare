<?php
namespace Incidents\Model\Entity;

use Cake\ORM\Entity;

/**
 * SubSupportType Entity.
 */
class SubSupportType extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'parent_id' => true,
        'title' => true,
        'icon' => true,
        'pos' => true,
    ];
}
