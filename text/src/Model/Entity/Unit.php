<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Unit Entity
 *
 * @property int $units_id
 * @property int $bases_id
 * @property string $unit
 * @property int $unit_sort_number
 *
 * @property \App\Model\Entity\Basis $basis
 */
class Unit extends Entity
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
        'bases_id' => true,
        'unit' => true,
        'unit_sort_number' => true,
        'basis' => true
    ];
}
