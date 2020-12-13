<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

class Symptom extends Entity
{
    protected $_accessible = [
        'symptoms' => true,
        'interview_symptoms' => true,
    ];
}
