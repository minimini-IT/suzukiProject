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

    /*
     * patients view
     * 症状に対する部位の数を数える
     * tableのrow数
     */
    protected function _getSymptomsRow()
    {
        $table_row = count($this->symptoms_locations);
        
        return $table_row;
    }
}
