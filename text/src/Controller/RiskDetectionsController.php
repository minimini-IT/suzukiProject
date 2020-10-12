<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
use RuntimeException;
use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use App\Controller\Component\FileuploadComponent;
use Cake\ORM\TableRegistry;
use Cake\datasource\ConnectionManager;

/**
 * RiskDetections Controller
 *
 * @property \App\Model\Table\RiskDetectionsTable $RiskDetections
 *
 * @method \App\Model\Entity\RiskDetection[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RiskDetectionsController extends AppController
{
    //$this->log("", LOG_DEBUG);
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
    }

    public function risk()
    {
        //検索結果用
        //if($this->request->is("post"))
        $data = $this->request->query();
        if($this->request->is("get") && $data != null)
        {
            //$data = $this->request->getData();
            $between = null;
            //日付指定がある場合はfindよりさきにbetweenの定義が必要
            if($data["response_start_time"] != "")
            {
                $searchStartDay = $data["response_start_time"];
                $searchEndDay = $data["response_start_time_end"];
                $between = ["conditions" => ["RiskDetections.response_start_time between '" . $searchStartDay . "' and '" . $searchEndDay . "'"]];
            }


            if($between === null)
            {
                $riskOnly = $this->RiskDetections->find("all")
                ->where(["incident_cases_id" => 2]);
            }
            else
            {
                $riskOnly = $this->RiskDetections->find("all", $between)
                ->where(["incident_cases_id" => 2]);
            }
            foreach($data as $key => $value)
            {
                //全検索
                if($value != "")
                {
                    if($key == "comment")
                    {
                        $riskOnly = $riskOnly->where(["RiskDetections." . $key => "%" . $value . "%"]);
                    }
                    else if($key == "response_start_time" || $key == "response_start_time_end" || $key == "page")
                    {
                        //何もしない
                    }
                    else
                    {
                        $riskOnly = $riskOnly->where(["RiskDetections." . $key => (int)$value]);
                    }
                }
            }
        }
        else
        {
            $riskOnly = $this->RiskDetections->find("all")
                ->where(["RiskDetections.statuses_id !=" => 3])
                ->where(["incident_cases_id" => 2]);
        }
        $this->paginate = [
            'contain' => [
                'Systems', 
                'Bases', 
                'Units', 
                'Statuses', 
                'Reports', 
                'Positives', 
                'SecLevels', 
                "IncidentManagements.ManagementPrefixes",
                "IncidentChronologies.Users",
                'InfectionRoutes'
            ],
            "limit" => 5,
            "order" => ["risk_detections_id" => "desc"]
        ];
        //$riskDetections = $this->paginate($this->RiskDetections);
        //incident_caseがウイルス検知のもののみ
        $riskDetections = $this->paginate($riskOnly);
        $systems = $this->RiskDetections->Systems->find('list', ['limit' => 200]);
        $bases = $this->RiskDetections->Bases->find('list', ['limit' => 200]);
        $units = $this->RiskDetections->Units->find('list', ['limit' => 200]);
        $statuses = $this->RiskDetections->Statuses->find('list', ['limit' => 200]);
        $reports = $this->RiskDetections->Reports->find('list', ['limit' => 200]);
        $positives = $this->RiskDetections->Positives->find('list', ['limit' => 200]);
        $secLevels = $this->RiskDetections->SecLevels->find('list', ['limit' => 200]);
        $infectionRoutes = $this->RiskDetections->InfectionRoutes->find('list', ['limit' => 200]);
        $this->loadModels(["incidentChronologies"]);
        $incidentChronology = $this->incidentChronologies->newEntity();
        $users = $this->RiskDetections->incidentChronologies->Users->find('list', ['limit' => 200])
          ->where(["delete_flag" => 0]);

        $this->set(compact('riskDetections', "systems", 'bases', 'units', 'statuses', 'reports', 'positives', 'secLevels', 'infectionRoutes', "incidentChronology", "users"));
    }

    public function malmail()
    {
        //if($this->request->is("post"))
        $data = $this->request->query();
        if($this->request->is("get") && $data != null)
        {
            //$data = $this->request->getData();
            $between = null;
            if($data["response_start_time"] != "")
            {
                $searchStartDay = $data["response_start_time"];
                $searchEndDay = $data["response_start_time_end"];
                //betweenはfindより先に定義する必要がある
                $between = ["conditions" => ["RiskDetections.response_start_time between '" . $searchStartDay . "' and '" . $searchEndDay . "'"]];
            }
            if($between === null)
            {
                $riskOnly = $this->RiskDetections->find("all")
                    ->where(["incident_cases_id" => 1]);
            }
            else
            {
                $riskOnly = $this->RiskDetections->find("all", $between)
                    ->where(["incident_cases_id" => 1]);
            }
            foreach($data as $key => $value)
            {
                if($value != "")
                {
                    if($key == "comment")
                    {
                        $riskOnly = $riskOnly->where(["RiskDetections." . $key => "%" . $value . "%"]);
                    }
                    else if($key == "response_start_time" || $key == "response_start_time_end" || $key == "page")
                    {
                        //何もしない
                    }
                    else
                    {
                        $riskOnly = $riskOnly->where(["RiskDetections." . $key => (int)$value]);
                    }
                }
            }
        }
        else
        {
            $riskOnly = $this->RiskDetections->find("all")
                ->where(["RiskDetections.statuses_id !=" => 3])
                ->where(["incident_cases_id" => 1]);
        }
        $this->paginate = [
            'contain' => [
                'Systems', 
                'Bases', 
                'Units', 
                'Statuses', 
                'Reports', 
                'Positives', 
                'SecLevels', 
                'SuspiciousDestinationAddresses', 
                'SuspiciousLinks', 
                "IncidentManagements.ManagementPrefixes",
                "IncidentChronologies.Users",
                'InfectionRoutes'
            ],
            "limit" => 5,
            "order" => ["risk_detections_id" => "desc"]
        ];
        //incident_caseがウイルス検知のもののみ
        $riskDetections = $this->paginate($riskOnly);
        $systems = $this->RiskDetections->Systems->find('list', ['limit' => 200]);
        $bases = $this->RiskDetections->Bases->find('list', ['limit' => 200]);
        $units = $this->RiskDetections->Units->find('list', ['limit' => 200]);
        $statuses = $this->RiskDetections->Statuses->find('list', ['limit' => 200]);
        $reports = $this->RiskDetections->Reports->find('list', ['limit' => 200]);
        $positives = $this->RiskDetections->Positives->find('list', ['limit' => 200]);
        $secLevels = $this->RiskDetections->SecLevels->find('list', ['limit' => 200]);
        $this->loadModels(["incidentChronologies", "suspiciousDestinationAddresses", "suspiciousLinks"]);
        $incidentChronology = $this->incidentChronologies->newEntity();
        $destinationAddress = $this->suspiciousDestinationAddresses->newEntity();
        $link = $this->suspiciousLinks->newEntity();
        $users = $this->RiskDetections->incidentChronologies->Users->find('list', ['limit' => 200])
          ->where(["delete_flag" => 0]);

        $this->set(compact(
            'riskDetections', 
            "systems", 
            'bases', 
            'units', 
            'statuses', 
            'reports', 
            'positives', 
            'secLevels', 
            "incidentChronology", 
            'destinationAddress', 
            "users",
            "link"
        ));
    }

    public function spreadsheet()
    {
        $year = date("Y") . "-04-01";
        $startDay = $year;
        //$incidents = [];
        //$malwares = [];
        for($i = 0; $i <= 4; $i++)
        {
            $endDay = date("Y-m-d", strtotime("+1 year", strtotime($startDay)));
            $between = ["conditions" => ["RiskDetections.response_start_time between '" . $startDay . "' and '" . $endDay . "'"]];
            $query = $this->RiskDetections->find("all", $between)
                ->where(["reports_id" => 3]);
            $malware[$i] = $query->count();
            $query = $this->RiskDetections->find("all", $between);
            $incident[$i] = $query->count();
            $startDay = date("Y-m-d", strtotime("-1 year", strtotime($startDay)));
        }
        $this->set(compact("year", "incident", "malware"));
    }

    public function malmailDestination()
    {
        $this->loadModels(["suspiciousDestinationAddresses"]);
        $sql = "select count(destination_address) duplicate_count, destination_address from suspicious_destination_addresses group by destination_address having count(destination_address) > 2 order by duplicate_count desc";
        $connection = ConnectionManager::get("default");
        $suspiciousAddresses = $connection->execute($sql)->fetchAll("assoc");
        /*
        $suspiciousAddresses = $this->suspiciousDestinationAddresses->find("all")
            ->select("destination_address");
         */
        $this->set(compact("suspiciousAddresses"));
    }

    /**
     * View method
     *
     * @param string|null $id Risk Detection id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $riskDetection = $this->RiskDetections->get($id, [
            'contain' => ['Systems', 'Bases', 'Units', 'Statuses', 'Reports', 'Positives', 'SecLevels', 'InfectionRoutes']
        ]);

        $this->set('riskDetection', $riskDetection);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function riskAdd()
    {
        $riskDetection = $this->RiskDetections->newEntity();
        if ($this->request->is('post')) 
        {
            $this->IncidentManagement = $this->loadComponent("IncidentAdd");
            $data = $this->request->getData();

            //save前にincident_managements更新
            if(is_int($incidentNumber = $this->IncidentManagement->incident_number(5)))
            {
                //インシデント番号生成成功したら
                $data = array_merge($data, ["incident_managements_id" => $incidentNumber]);
                $riskDetection = $this->RiskDetections->patchEntity($riskDetection, $data);

                if ($this->RiskDetections->save($riskDetection)) 
                {
                    $this->Flash->success(__('riskDetections 保存成功'));
                    return $this->redirect(['action' => 'risk']);
                }
                $this->Flash->error(__('インシデントID生成成功、risk_detections save 失敗'));
            }
            $this->Flash->error(__('インシデントID生成失敗'));
        }
        $systems = $this->RiskDetections->Systems->find('list', ['limit' => 200]);
        $bases = $this->RiskDetections->Bases->find('list', ['limit' => 200]);
        $units = $this->RiskDetections->Units->find('list', ['limit' => 200]);
        $statuses = $this->RiskDetections->Statuses->find('list', ['limit' => 200]);
        $reports = $this->RiskDetections->Reports->find('list', ['limit' => 200]);
        $positives = $this->RiskDetections->Positives->find('list', ['limit' => 200]);
        $secLevels = $this->RiskDetections->SecLevels->find('list', ['limit' => 200]);
        $infectionRoutes = $this->RiskDetections->InfectionRoutes->find('list', ['limit' => 200]);
        $this->set(compact('riskDetection', 'systems', 'bases', 'units', 'statuses', 'reports', 'positives', 'secLevels', 'infectionRoutes'));
    }

    public function malmailAdd()
    {
        $riskDetection = $this->RiskDetections->newEntity();
        if ($this->request->is('post')) {
            $this->IncidentManagement = $this->loadComponent("IncidentAdd");
            $data = $this->request->getData();

            //save前にincident_managements更新
            if(is_int($incidentNumber = $this->IncidentManagement->incident_number(5)))
            {
                //インシデント番号生成成功したら
                $data = array_merge($data, ["incident_managements_id" => $incidentNumber]);
                $riskDetection = $this->RiskDetections->patchEntity($riskDetection, $data);

                if ($this->RiskDetections->save($riskDetection)) 
                {
                    $this->Flash->success(__('riskDetections 保存成功'));
                    return $this->redirect(['action' => 'malmail']);
                }
                $this->Flash->error(__('インシデントID生成成功、risk_detections save 失敗'));
                return $this->redirect(['action' => 'malmailAdd']);
            }
            $this->Flash->error(__('インシデントID生成失敗'));
        }
        $systems = $this->RiskDetections->Systems->find('list', ['limit' => 200]);
        $bases = $this->RiskDetections->Bases->find('list', ['limit' => 200]);
        $units = $this->RiskDetections->Units->find('list', ['limit' => 200]);
        $statuses = $this->RiskDetections->Statuses->find('list', ['limit' => 200]);
        $reports = $this->RiskDetections->Reports->find('list', ['limit' => 200]);
        $positives = $this->RiskDetections->Positives->find('list', ['limit' => 200]);
        $secLevels = $this->RiskDetections->SecLevels->find('list', ['limit' => 200]);
        $infectionRoutes = $this->RiskDetections->InfectionRoutes->find('list', ['limit' => 200]);
        $this->set(compact('riskDetection', 'systems', 'bases', 'units', 'statuses', 'reports', 'positives', 'secLevels', 'infectionRoutes'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Risk Detection id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $riskDetection = $this->RiskDetections->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $riskDetection = $this->RiskDetections->patchEntity($riskDetection, $this->request->getData());
            if ($this->RiskDetections->save($riskDetection)) {
                $this->Flash->success(__('The risk detection has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The risk detection could not be saved. Please, try again.'));
        }
        $systems = $this->RiskDetections->Systems->find('list', ['limit' => 200]);
        $bases = $this->RiskDetections->Bases->find('list', ['limit' => 200]);
        $units = $this->RiskDetections->Units->find('list', ['limit' => 200]);
        $statuses = $this->RiskDetections->Statuses->find('list', ['limit' => 200]);
        $reports = $this->RiskDetections->Reports->find('list', ['limit' => 200]);
        $positives = $this->RiskDetections->Positives->find('list', ['limit' => 200]);
        $secLevels = $this->RiskDetections->SecLevels->find('list', ['limit' => 200]);
        $infectionRoutes = $this->RiskDetections->InfectionRoutes->find('list', ['limit' => 200]);
        $this->set(compact('riskDetection', 'systems', 'bases', 'units', 'statuses', 'reports', 'positives', 'secLevels', 'infectionRoutes'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Risk Detection id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $riskDetection = $this->RiskDetections->get($id);
        if ($this->RiskDetections->delete($riskDetection)) {
            $this->Flash->success(__('The risk detection has been deleted.'));
        } else {
            $this->Flash->error(__('The risk detection could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
