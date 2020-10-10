<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\ORM\TableRegistry;

/**
 * IncidentAdd component
 */
class IncidentAddComponent extends Component
{
    public function initialize(array $config)
    {
        $this->IncidentManagements = TableRegistry::getTableLocator()->get("incidentManagements");
    }
    
    protected $_defaultConfig = [];

    protected $number = 1;
    protected $incident_number = array();

    public function incident_number($prefix)
    {
        //$this->log("---prefix---", LOG_DEBUG);
        //$this->log($prefix, LOG_DEBUG);
        
        $this->log("---IncidentAdd start---", LOG_DEBUG);

        $today = Date("Y-m-d");

        //$this->log("---today---", LOG_DEBUG);
        //$this->log($today, LOG_DEBUG);

        $datetime = Date("Y-m-d H:i:s");
        $number_now = $this->IncidentManagements
            ->find("all")
            ->select("number")
            ->where(["created" => $today]);

        $number_now = $number_now->count();

        //$this->log("---number_now---", LOG_DEBUG);
        //$this->log($number_now, LOG_DEBUG);

        $entity = [
            "management_prefixes_id" => $prefix,
            "created" => $today,
            "modified" => $datetime
        ];

        //if(is_null($number_now))
        if(empty($number_now))
        {
            //本日初めてインシデントを作成する場合の処理
            $entity = array_merge($entity, ["number" => 1]);
        }
        else
        {
            //本日２回目以降にインシデントを作成する場合の処理
            $entity = array_merge($entity, ["number" => $number_now + 1]);
        }

        //$this->log("---entiry---", LOG_DEBUG);
        //$this->log($entity, LOG_DEBUG);

        if(is_int($incidentId = $this->incident_add($entity)))
        {
            //$this->log("---incidentId---", LOG_DEBUG);
            //$this->log($incidentId, LOG_DEBUG);

            return $incidentId;
        }
        //$this->log("---incidentId---", LOG_DEBUG);
        //$this->log($incidentId, LOG_DEBUG);
        return false;
    }

    public function incident_add($entity)
    {
        $incidentManagement = $this->IncidentManagements->newEntity();

        //$this->log("---newEntity incidentManagement---", LOG_DEBUG);
        //$this->log($incidentManagement, LOG_DEBUG);
        
        $incidentManagement = $this->IncidentManagements->patchEntity($incidentManagement, $entity);

        //$this->log("---patchEntity incidentManagement---", LOG_DEBUG);
        //$this->log($incidentManagement, LOG_DEBUG);

        if ($this->IncidentManagements->save($incidentManagement)) 
        {
            $incidentId = $incidentManagement->incident_managements_id;
            return $incidentId;
        }
        return false;
    }
}
