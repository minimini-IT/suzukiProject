<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

class Article extends Entity
{
    protected $_accessible = [
        'title' => true,
        'contents' => true,
        'created' => true,
        'modified' => true,
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
    }

    protected function _getRelatedArticlesSickness()
    {
        return (int)$this->si["sicknesses_id"];
    }

    protected function _getRelatedArticlesSymptoms()
    {
        return (int)$this->sy["symptoms_id"];
    }

    protected function _getRelatedArticlesLocations()
    {
        return (int)$this->l["locations_id"];
    }

    protected function _getAttributeList()
    {
        $list = array();
        $list["sickness"] = array();
        $list["symptoms"] = array();
        $list["locations"] = array();
        foreach($this->related_sicknesses as $si)
        {
            if(!in_array($si->sickness->sickness_name, $list["sickness"]))
            {
                array_push($list["sickness"], $si->sickness->sickness_name);
            }
        }
        foreach($this->related_symptoms as $sy)
        {
            if(!in_array($sy->symptom->symptoms, $list["symptoms"]))
            {
                array_push($list["symptoms"], $sy->symptom->symptoms);
            }
        }
        foreach($this->related_locations as $lo)
        {
            if(!in_array($lo->location->location, $list["locations"]))
            {
                array_push($list["locations"], $lo->location->location);
            }
        }
        return $list;
    }

}
