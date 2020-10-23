<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Diseased Entity
 *
 * @property int $diseaseds_id
 * @property int $patients_id
 * @property int $sicknesses_id
 *
 * @property \App\Model\Entity\Patient $patient
 * @property \App\Model\Entity\Sickness $sickness
 */
class Diseased extends Entity
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
        'patients_id' => true,
        'sicknesses_id' => true,
        'patient' => true,
        'sickness' => true,
    ];
}
