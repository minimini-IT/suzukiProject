<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * MessageFile Entity
 *
 * @property int $message_files_id
 * @property int $message_bords_id
 * @property string $file_name
 * @property string $file_size
 * @property string $unique_file_name
 *
 * @property \App\Model\Entity\MessageBord $message_bord
 */
class MessageFile extends Entity
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
        'message_bords_id' => true,
        'file_name' => true,
        'file_size' => true,
        'unique_file_name' => true,
        'message_bord' => true
    ];
}
