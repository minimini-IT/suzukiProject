<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * SymptomsLocation Entity
 *
 * @property int $symptoms_locations_id
 * @property int $interview_symptoms_id
 * @property int $locations_id
 *
 * @property \App\Model\Entity\InterviewSymptom $interview_symptom
 * @property \App\Model\Entity\Location $location
 */
class SymptomsLocation extends Entity
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
        'interview_symptoms_id' => true,
        'locations_id' => true,
        'interview_symptom' => true,
        'location' => true,
    ];
}
