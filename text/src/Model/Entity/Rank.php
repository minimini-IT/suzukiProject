<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Rank Entity
 *
 * @property int $ranks_id
 * @property string $rank
 * @property string $abb_rank
 * @property int $rank_sort_number
 */
class Rank extends Entity
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
        'rank' => true,
        'abb_rank' => true,
        'rank_sort_number' => true
    ];
}
