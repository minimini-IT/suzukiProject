<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * IncidentChronology Entity
 *
 * @property int $incident_chronologies_id
 * @property int $risk_detections_id
 * @property \Cake\I18n\FrozenTime $created
 * @property int $users_id
 * @property string|null $message
 * @property string|null $reference
 *
 * @property \App\Model\Entity\RiskDetection $risk_detection
 * @property \App\Model\Entity\User $user
 */
class IncidentChronology extends Entity
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
        'risk_detections_id' => true,
        'created' => true,
        'users_id' => true,
        'message' => true,
        'reference' => true,
        'risk_detection' => true,
        'user' => true
    ];
}
