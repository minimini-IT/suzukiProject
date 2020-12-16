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
        'diagnosis_date' => true,
        'cured' => true,
        'interview_first' => true,
        'interview_second' => true,
        'interview_third' => true,
        'interview_force' => true,
        'other' => true,
        'created' => true,
        'modified' => true,
        'sickness' => true,
        'patient_sex' => true,
    ];

    /*
     * patients view
     * 関連するインタビューの同じ病気のインタビューを参照するのに使用
     */
    protected function _getRelatedSickness()
    {
        return (int)$this->d["sicknesses_id"];
    }

    /*
     * patients view
     * 関連するインタビューの同じ症状のインタビューを参照するのに使用
     */
    protected function _getRelatedSymptoms()
    {
        return (int)$this->i["symptoms_id"];
    }
}
