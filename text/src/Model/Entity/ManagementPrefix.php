<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ManagementPrefix Entity
 *
 * @property int $management_prefixes_id
 * @property string $management_prefix
 * @property int $sort_number
 */
class ManagementPrefix extends Entity
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
        'management_prefix' => true,
        'sort_number' => true
    ];
}
