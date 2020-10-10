<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * MessageAnswer Entity
 *
 * @property int $message_answers_id
 * @property int $message_destinations_id
 * @property int $message_choices_id
 * @property string|null $message
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\MessageDestination $message_destination
 * @property \App\Model\Entity\MessageStatus $message_status
 */
class MessageAnswer extends Entity
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
        'message_destinations_id' => true,
        'message_choices_id' => true,
        'message' => true,
        'created' => true,
        'modified' => true,
        'message_destination' => true,
        'message_status' => true
    ];
}
