<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PrivateMessage Entity
 *
 * @property int $private_messages_id
 * @property int $message_bords_id
 * @property int $users_id
 *
 * @property \App\Model\Entity\MessageBord $message_bord
 * @property \App\Model\Entity\User $user
 */
class PrivateMessage extends Entity
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
        'users_id' => true,
        'message_bord' => true,
        'user' => true
    ];
}
