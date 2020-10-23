<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Represent Entity
 *
 * @property int $represents_id
 * @property int $sicknesses_id
 * @property int $symptoms_id
 *
 * @property \App\Model\Entity\Sickness $sickness
 * @property \App\Model\Entity\Symptom $symptom
 */
class Represent extends Entity
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
        'sicknesses_id' => true,
        'symptoms_id' => true,
        'sickness' => true,
        'symptom' => true,
    ];
}
