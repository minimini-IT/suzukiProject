<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * InterviewSymptoms Controller
 *
 * @property \App\Model\Table\InterviewSymptomsTable $InterviewSymptoms
 * @method \App\Model\Entity\InterviewSymptom[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class InterviewSymptomsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            //'contain' => ['Patients', 'Symptoms'],
            'contain' => ['Diseaseds', 'Symptoms'],
        ];
        $interviewSymptoms = $this->paginate($this->InterviewSymptoms);

        $this->set(compact('interviewSymptoms'));
    }

    /**
     * View method
     *
     * @param string|null $id Interview Symptom id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $interviewSymptom = $this->InterviewSymptoms->get($id, [
            //'contain' => ['Patients', 'Symptoms', 'SymptomsLocations'],
            'contain' => ['Diseaseds', 'Symptoms', 'SymptomsLocations'],
        ]);

        $this->set(compact('interviewSymptom'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    //public function add()
    public function add($patients_id = null)
    {
        //idはpatients_id
        $count = null;
        $symptoms_number = null;
        $this->loadModels(["Diseaseds"]);
        //$interviewSymptom = $this->InterviewSymptoms->newEmptyEntity();
        //$this->log("---id---", LOG_DEBUG);
        //$this->log($id, LOG_DEBUG);
        //$this->log("---request get---", LOG_DEBUG);
        //$this->log(print_r($this->request->getData(), true), LOG_DEBUG);
        //if ($this->request->is('post') && $id == null) {

        if ($this->request->is('post')) {
            //$this->log("---post---", LOG_DEBUG);
            $data = $this->request->getData();
            //$data_p = print_r($data, true);
            //$this->log("---request data---", LOG_DEBUG);
            //$this->log($data_p, LOG_DEBUG);
            $patients_id = $data["patients_id"];
            //$id = $data["diseaseds_id"];
            $diseaseds_id = $data["diseaseds_id"];

            //sicknesses_id取得
            $sicknesses_id = array();
            //$diseaseds = $this->Diseaseds->find()->where(["patients_id" => $id])->all();
            $diseaseds = $this->Diseaseds->find()->where(["diseaseds_id" => $diseaseds_id])->all();
            foreach($diseaseds as $diseased)
            {
                array_push($sicknesses_id, $diseased->sicknesses_id);
            }
            //$this->log(print_r($diseaseds->toList(), true), LOG_DEBUG);
            //$this->log(print_r($sicknesses_id, true), LOG_DEBUG);

            //entity作成
            $entity = array();
            $interview_symptoms_entities = array();
            foreach($sicknesses_id as $sickness_id)
            {
                foreach($data["symptoms_id_{$sickness_id}"] as $symptoms_id)
                {
                    //$entity["patients_id"] = $data["patients_id"];
                    $entity["diseaseds_id"] = $data["diseaseds_id"];
                    $entity["symptoms_id"] = $symptoms_id;
                    array_push($interview_symptoms_entities, $entity);
                    //$this->log("---interview_symptoms_entities---", LOG_DEBUG);
                    //$this->log(print_r($interview_symptoms_entities, true), LOG_DEBUG);
                }
                //$this->log("---sickness_id---", LOG_DEBUG);
                //$this->log(print_r($sickness_id, true), LOG_DEBUG);
            }

            $interviewSymptoms = $this->InterviewSymptoms->newEntities($interview_symptoms_entities);
            $interviewSymptoms = $this->InterviewSymptoms->patchEntities($interviewSymptoms, $interview_symptoms_entities);
            $this->log("---interviewSymptoms---", LOG_DEBUG);
            $this->log(print_r($interviewSymptoms, true), LOG_DEBUG);
            if($this->InterviewSymptoms->saveMany($interviewSymptoms))
            {
                $this->Flash->success(__('The interview symptom has been saved.'));

                return $this->redirect(["controller" => "Patients", 'action' => 'view', $patients_id]);

            }
            $this->Flash->error(__('The interview symptom could not be saved. Please, try again.'));


            //return $this->redirect(['action' => 'add', $id]);
            /*
            $interviewSymptom = $this->InterviewSymptoms->patchEntity($interviewSymptom, $this->request->getData());
            if ($this->InterviewSymptoms->save($interviewSymptom)) {
                $this->Flash->success(__('The interview symptom has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The interview symptom could not be saved. Please, try again.'));
             */
        }
        //if($id != null)
        //{

        //$symptoms_number = $this->InterviewSymptoms->Diseaseds->find()
        $symptoms_number = $this->Diseaseds->find()
            ->contain(["Sicknesses"])
            ->where(["patients_id" => $patients_id])
            ->all();
        $symptoms_number_array = array();
        foreach($symptoms_number as $number)
        {
            array_push($symptoms_number_array, $number->sicknesses_id);
        }
        //$symptoms_number_p = $symptoms_number;
        //$this->log("---表示するsickness---", LOG_DEBUG);
        //$this->log(print_r($symptoms_number_p->toList(), true), LOG_DEBUG);
        //$this->log(print_r($symptoms_number_array, true), LOG_DEBUG);
        $count = $symptoms_number->count();
        //$this->log("---count---", LOG_DEBUG);
        //$this->log(print_r($count, true), LOG_DEBUG);
        //}

        //patientのsicknessを導くためのdiseaseds_id
        $patient_sickness = $this->Diseaseds->find()
            ->select(["diseaseds_id"])
            ->where(["patients_id" => $patients_id]);
            //->group(["diseaseds_id"]);
        //$patient_sickness_p = $patient_sickness;
        $patient_sickness_array = array();
        foreach($patient_sickness as $p_sickness)
        {
            array_push($patient_sickness_array, $p_sickness->diseaseds_id);
        }
        //$this->log("---patientsのsicknessを導くためのdiseaseds_id---", LOG_DEBUG);
        //$this->log("---入力が必要なdiseaseds_id---", LOG_DEBUG);
        //$this->log(print_r($patient_sickness_p->toList(), true), LOG_DEBUG);
        //$this->log(print_r($patient_sickness_array, true), LOG_DEBUG);
        /*
        //patientsのsicknessが紐づけられたdiseaseds_id
        $patient_sickness_diseaseds = array();
        foreach($patient_sickness as $PSDiseaseds)
        {
            array_push($patient_sickness_diseaseds, $PSDiseaseds->diseaseds_id);
        }
         */

        $entered_sickness_diseaseds = array();
        //入力済みのpatientのsicknessのsymptoms
        $entered_sickness = $this->InterviewSymptoms->find()
            ->select(["diseaseds_id"])
            ->where(["diseaseds_id in" => $patient_sickness]);
            //->all();
        //$this->log(print_r($entered_sickness_p, true), LOG_DEBUG);
        //$this->log(print_r($entered_sickness_p->toList(), true), LOG_DEBUG);
        foreach($entered_sickness as $ESDiseased)
        {
            array_push($entered_sickness_diseaseds, $ESDiseased->diseaseds_id);
        }
        $entered_sickness_diseaseds_p = $entered_sickness_diseaseds;
        //$this->log("---入力済みのdiseaseds_id---", LOG_DEBUG);
        //$this->log(print_r($entered_sickness_diseaseds, true), LOG_DEBUG);

        //スキップ可能なsicknesses_idを導くためのdiseaseds_id
        $skip_diseaseds_id = array();
        //$skip_sicknesses_id = array();
        //patient_sicknessとentered_sicknessの差分から、入力すべきpatientsのsicknessを特定
        foreach($patient_sickness as $PSDiseased)
        {
            //もしpatient_sicknessのdiseaseds_idがentered_sickness_diseasedsになければ
            if(in_array($PSDiseased->diseaseds_id, $entered_sickness_diseaseds) && !in_array($PSDiseased->diseaseds_id, $skip_diseaseds_id))
            {
                //未入力分のinterview_symptomsを特定
                array_push($skip_diseaseds_id, $PSDiseased->diseaseds_id);
            }
        }
        $skip_diseaseds_id_p = $skip_diseaseds_id;
        //$this->log("---スキップ可能なsicknesses_idを導くためのdiseaseds_id", LOG_DEBUG);
        //$this->log(print_r($skip_diseaseds_id_p, true), LOG_DEBUG);
        //スキップ可能なsicknesses_id
        $skip_sicknesses_id = $this->Diseaseds->find()
            //->contain(["Sicknesses"])
            ->select(["sicknesses_id"])
            ->where(["diseaseds_id in" => $skip_diseaseds_id]);
        //$skip_sicknesses_id_p = $skip_sicknesses_id;
        //スキップ可能なsicknesses_id
        $skip_sicknesses_id_array = array();
        //$this->log("---スキップ可能なsicknesses_id", LOG_DEBUG);
        foreach($skip_sicknesses_id as $skip)
        {
            array_push($skip_sicknesses_id_array, $skip->sicknesses_id);
        }
        //$this->log(print_r($skip_sicknesses_id_p, true), LOG_DEBUG);
        //$this->log(print_r($skip_sicknesses_id_array, true), LOG_DEBUG);


        //$patients = $this->InterviewSymptoms->Patients->find('list', ['limit' => 200]);
        $symptoms = $this->InterviewSymptoms->Symptoms->find('list', ['limit' => 200]);
        //$this->set(compact('interviewSymptom', 'patients', 'symptoms'));
        //$this->set(compact('interviewSymptom', 'symptoms', "id", "count", "symptoms_number"));
        //$this->set(compact('symptoms', "id", "count", "symptoms_number", "entered_sickness", "skip_sicknesses_id_array"));
        $this->set(compact('symptoms', "patients_id", "symptoms_number", "skip_sicknesses_id_array"));
    }

    /**
     * Edit method
     *
     * @param string|null $id Interview Symptom id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $interviewSymptom = $this->InterviewSymptoms->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $interviewSymptom = $this->InterviewSymptoms->patchEntity($interviewSymptom, $this->request->getData());
            if ($this->InterviewSymptoms->save($interviewSymptom)) {
                $this->Flash->success(__('The interview symptom has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The interview symptom could not be saved. Please, try again.'));
        }
        $patients = $this->InterviewSymptoms->Patients->find('list', ['limit' => 200]);
        $symptoms = $this->InterviewSymptoms->Symptoms->find('list', ['limit' => 200]);
        $this->set(compact('interviewSymptom', 'patients', 'symptoms'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Interview Symptom id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $interviewSymptom = $this->InterviewSymptoms->get($id);
        if ($this->InterviewSymptoms->delete($interviewSymptom)) {
            $this->Flash->success(__('The interview symptom has been deleted.'));
        } else {
            $this->Flash->error(__('The interview symptom could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
