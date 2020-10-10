<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Patient Entity
 *
 * @property int $patients_id
 * @property string $patients_initial
 * @property int $sicknesses_id
 * @property int $patient_sexes_id
 * @property int $age_of_onset
 * @property \Cake\I18n\FrozenDate $year_of_onset
 * @property \Cake\I18n\FrozenDate|null $cured
 * @property string|null $comment
 *
 * @property \App\Model\Entity\Sickness $sickness
 * @property \App\Model\Entity\PatientSex $patient_sex
 */
class Patient extends Entity
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
        'patients_initial' => true,
        'sicknesses_id' => true,
        'patient_sexes_id' => true,
        'age_of_onset' => true,
        'year_of_onset' => true,
        'cured' => true,
        'comment' => true,
        'sickness' => true,
        'patient_sex' => true,
    ];
}
