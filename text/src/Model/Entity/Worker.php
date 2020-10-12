<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Worker Entity
 *
 * @property \Cake\I18n\FrozenDate $date
 * @property int $users_id
 * @property int $classes_id
 * @property int|null $positions_id
 * @property int $shifts_id
 * @property int|null $duties_id
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Class $class
 * @property \App\Model\Entity\Position $position
 * @property \App\Model\Entity\Shift $shift
 * @property \App\Model\Entity\Duty $duty
 */
class Worker extends Entity
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
        'date' => true,
        'users_id' => true,
        'positions_id' => true,
        'shifts_id' => true,
        'duties_id' => true,
        'user' => true,
        'position' => true,
        'shift' => true,
        'duty' => true
    ];
}
