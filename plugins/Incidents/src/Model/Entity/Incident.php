<?php
namespace Incidents\Model\Entity;

use Cake\ORM\Entity;

/**
 * Incident Entity.
 */
class Incident extends Entity
{

    const AGE_1 = 1;
    const AGE_2 = 2;
    const AGE_3 = 3;
    const AGE_4 = 4;

    const INTOX_1 = 1;
    const INTOX_2 = 2;
    const INTOX_3 = 3;
    const INTOX_4 = 4;

    const RECEPT_1 = 1;
    const RECEPT_2 = 2;
    const RECEPT_3 = 3;

    public static function ageList()
    {
        return [
            self::AGE_1 => __('< 18'),
            self::AGE_2 => __('18 - 25'),
            self::AGE_3 => __('26 - 40'),
            self::AGE_4 => __('> 40'),
        ];
    }

    public static function intoxicationList($icons = false)
    {
        if ($icons) {
            return [
                self::INTOX_1 => '<i class="fa fa-coffee"></i>',
                self::INTOX_2 => '<i class="fa fa-beer fa-2x"></i>',
                self::INTOX_3 => '<i class="fa fa-beer fa-3x"></i>',
                self::INTOX_4 => '<i class="fa fa-eyedropper fa-2x"></i>',
            ];
        }

        return [
            self::INTOX_1 => __('Sober'),
            self::INTOX_2 => __('Mild'),
            self::INTOX_3 => __('Heavy'),
            self::INTOX_4 => __('Drugs'),
        ];
    }

    public static function receptivenessList($icons = false)
    {
        if ($icons) {
            return [
                self::RECEPT_1 => '<i class="fa fa-smile-o"></i>',
                self::RECEPT_2 => '<i class="fa fa-meh-o"></i>',
                self::RECEPT_3 => '<i class="fa fa-frown-o"></i>',
            ];
        }

        return [
            self::RECEPT_1 => __('Agreeable'),
            self::RECEPT_2 => __('Neutral'),
            self::RECEPT_3 => __('Disagreeable'),
        ];
    }

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'area_id' => true,
        'team_id' => true,
        'males_number' => true,
        'females_number' => true,
        'age' => true,
        'intoxication' => true,
        'receptiveness' => true,
        'referral_id' => true,
        'referral_comment' => true,
        'support_type_id' => true,
        'sub_support_type_id' => true,
        'comment' => true,
        'lat' => true,
        'lng' => true,
        'draft' => true,
        'police' => true,
        'contact' => true,
        'report' => true,
        'water_given' => true,
        'chupa_chups_given' => true,
        'thongs_given' => true,
        'vomit_bags_given' => true,
        'area' => true,
        'team' => true,
        'referral' => true,
        'support_type' => true,
        'sub_support_type' => true,
    ];
}
