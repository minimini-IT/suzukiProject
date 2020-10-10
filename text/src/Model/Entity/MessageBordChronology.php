<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * MessageBordChronology Entity
 *
 * @property int $message_bord_chronologies_id
 * @property int $message_bords_id
 * @property \Cake\I18n\FrozenTime $created
 * @property int $users_id
 * @property string|null $message
 *
 * @property \App\Model\Entity\MessageBord $message_bord
 * @property \App\Model\Entity\User $user
 */
class MessageBordChronology extends Entity
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
        'created' => true,
        'users_id' => true,
        'message' => true,
        'message_bord' => true,
        'user' => true
    ];
}
