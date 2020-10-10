<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CrewSendComment Entity
 *
 * @property int $crew_send_comments_id
 * @property int $crew_sends_id
 * @property int $users_id
 * @property int $file_group
 * @property string $comment
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\CrewSend $crew_send
 * @property \App\Model\Entity\User $user
 */
class CrewSendComment extends Entity
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
        'crew_sends_id' => true,
        'users_id' => true,
        'file_group' => true,
        'comment' => true,
        'created' => true,
        'modified' => true,
        'crew_send' => true,
        'user' => true
    ];
}
