<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

class Patient extends Entity
{
    protected $_accessible = [
        'pen_name' => true,
        'patient_sexes_id' => true,
        'age_of_onset' => true,
        'year_of_onset' => true,
        'cured' => true,
        'comment' => true,
        'created' => true,
        'modified' => true,
        'sickness' => true,
        'patient_sex' => true,
    ];
}
