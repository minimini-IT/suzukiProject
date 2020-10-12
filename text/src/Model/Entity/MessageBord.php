<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * MessageBord Entity
 *
 * @property int $message_bords_id
 * @property string $title
 * @property int $message_statuses_id
 * @property int $choice
 * @property string|null $message
 * @property \Cake\I18n\FrozenDate $period
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\MessageStatus $message_status
 * @property \App\Model\Entity\MessageDestination[] $message_destinations
 * @property \App\Model\Entity\MessageChoice[] $message_choices
 * @property \App\Model\Entity\MessageFile[] $message_files
 */
class MessageBord extends Entity
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
        'title' => true,
        'message_statuses_id' => true,
        'incident_managements_id' => true,
        'users_id' => true,
        'choice' => true,
        'message' => true,
        'period' => true,
        'created' => true,
        'modified' => true,
        'users' => true,
        'message_status' => true,
        'message_destinations' => true,
        'message_choices' => true,
        'message_files' => true
    ];
}
