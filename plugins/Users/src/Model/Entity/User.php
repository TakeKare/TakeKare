<?php
namespace Users\Model\Entity;

use Cake\ORM\Entity;
use Cake\Auth\DefaultPasswordHasher;

/**
 * User Entity.
 */
class User extends Entity
{
    const ROLE_SUPER_ADMIN = 'super_admin';
    const ROLE_ADMIN = 'admin';
    const ROLE_TEAM_LEAD = 'team_lead';

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'team_id' => true,
        'name' => true,
        'email' => true,
        'password' => true,
        'hash' => true,
        'role' => true,
        'is_active' => true,
        'is_manager' => true,
        'is_owner' => true,
        'last_login_date' => true,
        'last_login_ip' => true,
    ];

    protected $_hidden = ['password', 'hash'];

    protected function _setPassword($password)
    {
        return (new DefaultPasswordHasher)->hash($password);
    }

    public static function roles()
    {
        return [
            self::ROLE_SUPER_ADMIN => __('Super Admin'),
            self::ROLE_ADMIN => __('Admin'),
            self::ROLE_TEAM_LEAD => __('Team Lead'),
        ];
    }
}
