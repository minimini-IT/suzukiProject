<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * File Entity
 *
 * @property int $files_id
 * @property int $file_group
 * @property string $file_name
 * @property string $file_size
 */
class File extends Entity
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
        'file_name' => true,
        'file_size' => true,
        'unique_file_name' => true,
        'crew_sends_id' => true
    ];
}
