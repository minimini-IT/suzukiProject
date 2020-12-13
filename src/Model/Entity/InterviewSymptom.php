<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

class InterviewSymptom extends Entity
{
    protected $_accessible = [
        'diseaseds_id' => true,
        'symptoms_id' => true,
        'created' => true,
        'modified' => true,
        'diseased' => true,
        'symptom' => true,
    ];
}
