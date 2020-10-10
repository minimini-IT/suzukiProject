<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Basis Entity
 *
 * @property int $bases_id
 * @property string $base
 * @property int $base_sort_number
 */
class Basis extends Entity
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
        'base' => true,
        'base_sort_number' => true
    ];
}
