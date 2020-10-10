<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * SuspiciousDestinationAddress Entity
 *
 * @property int $suspicious_destination_addresses_id
 * @property int $risk_detections_id
 * @property string $destination_address
 *
 * @property \App\Model\Entity\RiskDetection $risk_detection
 */
class SuspiciousDestinationAddress extends Entity
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
        'destination_address' => true,
        'risk_detection' => true
    ];
}
