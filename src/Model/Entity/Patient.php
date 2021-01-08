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

    protected function _getDateComparison()
    {
        $comparison = $this->modified->diff($this->created);  
        if($comparison->format("%a") == 0)
        {
            return true;
        }
        else
        {
            return false;
        }
        //return $comparison;
    }

    /*
     * patients view
     * 関連するインタビューの同じ病気のインタビューを参照するのに使用
     */
    protected function _getRelatedSickness()
    {
        return (int)$this->d["sicknesses_id"];
    }

    //protected function _getRelatedList()
    protected function _getAttributeList()
    {
        $list = array();
        $list["sickness"] = array();
        $list["symptoms"] = array();
        $list["locations"] = array();
        foreach($this->diseaseds as $d)
        {
            if(!in_array($d->sickness->sickness_name, $list["sickness"]))
            {
                array_push($list["sickness"], $d->sickness->sickness_name);
            }
            foreach($d->interview_symptoms as $i)
            {
                if(!in_array($i->symptom->symptoms, $list["symptoms"]))
                {
                    array_push($list["symptoms"], $i->symptom->symptoms);
                }
                foreach($i->symptoms_locations as $s)
                {
                    if(!in_array($s->location->location, $list["locations"]))
                    {
                        array_push($list["locations"], $s->location->location);
                    }
                }
            }
        }
        return $list;
    }

    /*
     * patients view
     * 関連するインタビューの同じ症状のインタビューを参照するのに使用
     */
    protected function _getRelatedSymptoms()
    {
        return (int)$this->i["symptoms_id"];
    }

    /*
     * patients view
     * 関連するインタビューの同じ症状のインタビューを参照するのに使用
     */
    protected function _getRelatedLocations()
    {
        return (int)$this->sl["locations_id"];
    }

    protected function _getRelatedLocationsFoundation()
    {
        $locationsList = array();

        foreach($this->diseaseds as $d)
        {
            foreach($d->interview_symptoms as $i)
            {
                foreach($i->symptoms_locations as $s)
                {
                    if(!array_key_exists($s->locations_id, $locationsList))
                    {
                        $locationsList[$s->locations_id] = $s->location->location;
                    }
                }
            }
        }

        //ifしてもなぜか重複するので
        $locationsList = array_unique($locationsList);

        return $locationsList;
    }

    protected function _getRelatedSymptomsFoundation()
    {
        $symptomsList = array();

        foreach($this->diseaseds as $d)
        {
            foreach($d->interview_symptoms as $i)
            {
                if(!array_key_exists($i->symptoms_id, $symptomsList))
                {
                    $symptomsList[$i->symptoms_id] = $i->symptom->symptoms;
                }
            }
        }

        //ifしてもなぜか重複するので
        $symptomsList = array_unique($symptomsList);

        return $symptomsList;
    }

    protected function _getRelatedSicknessFoundation()
    {
        $sicknessList = array();

        foreach($this->diseaseds as $d)
        {
            if(!array_key_exists($d->sicknesses_id, $sicknessList))
            {
                $sicknessList[$d->sicknesses_id] = $d->sickness->sickness_name;
            }
        }

        $sicknessList = array_unique($sicknessList);

        return $sicknessList;
    }
}
