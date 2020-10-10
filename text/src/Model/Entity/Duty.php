<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Duty Entity
 *
 * @property int $duties_id
 * @property string $duty
 * @property int $duty_sort_number
 */
class Duty extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'duty' => true,
        'duty_sort_number' => true
    ];
}
