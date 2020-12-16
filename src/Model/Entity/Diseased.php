<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

class Diseased extends Entity
{
    protected $_accessible = [
        'patients_id' => true,
        'sicknesses_id' => true,
        'patient' => true,
        'sickness' => true,
        'interview_symptoms' => true,
    ];

    /*
     * patients view
     * 病気に対する部位の数を数える
     * tableのrow数
     */
    protected function _getSicknessRow()
    {
        $table_row = 0;
        foreach($this->interview_symptoms as $i)
        {
            $table_row += count($i->symptoms_locations);
        }
        
        return $table_row;
    }
}
