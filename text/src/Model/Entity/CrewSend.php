<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CrewSend Entity
 *
 * @property int $crew_sends_id
 * @property int $categories_id
 * @property string $title
 * @property int $statuses_id
 * @property int $users_id
 * @property \Cake\I18n\FrozenTime|null $limit
 * @property int|null $file_group
 * @property string $comment
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modifed
 *
 * @property \App\Model\Entity\Category $category
 * @property \App\Model\Entity\Status $status
 * @property \App\Model\Entity\User $user
 */
class CrewSend extends Entity
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
        'categories_id' => true,
        'title' => true,
        'statuses_id' => true,
        'users_id' => true,
        'incident_managements_id' => true,
        'period' => true,
        'file_group' => true,
        'comment' => true,
        'category' => true,
        'status' => true,
        'user' => true
    ];
}
