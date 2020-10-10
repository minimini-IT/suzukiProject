<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * IncidentManagement Entity
 *
 * @property int $incident_managements_id
 * @property int $management_prefixes_id
 * @property \Cake\I18n\FrozenDate $created
 * @property int $number
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\ManagementPrefix $management_prefix
 */
class IncidentManagement extends Entity
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
        'management_prefixes_id' => true,
        'created' => true,
        'number' => true,
        'modified' => true,
        'management_prefix' => true
    ];
}
