<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Schedule Entity
 *
 * @property int $schedules_id
 * @property \Cake\I18n\FrozenDate $schedule_start_date
 * @property \Cake\I18n\FrozenDate $schedule_end_date
 * @property int $repe_flag
 * @property string $schedule
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 */
class Schedule extends Entity
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
        'schedule_start_date' => true,
        'schedule_end_date' => true,
        'repe_flag' => true,
        'schedule' => true,
        'created' => true,
        'modified' => true
    ];
}
