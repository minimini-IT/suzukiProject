<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/*
 * beforeRules用
 */
use Cake\Datasource\EntityInterface;
use Cake\Event\EventInterface;

class PatientsTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->addBehavior("Timestamp");

        $this->setTable('patients');
        $this->setDisplayField('patients_id');
        $this->setPrimaryKey('patients_id');

        $this->belongsTo('PatientSexes', [
            'foreignKey' => 'patient_sexes_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('Diseaseds', [
            'foreignKey' => 'patients_id',
            'joinType' => 'INNER',
        ]);
    }

    public function findSelectSearch(Query $query, array $options)
    {
        $pen_name = $options["pen_name"];

        return $query
            ->where(["pen_name" => $pen_name]);
    }

    public function findSearchSymptomsLocations(Query $query, array $options)
    {
        $symptoms_id = $options["symptoms_id"];
        $values = $options["values"];

        return $query
            ->find("JoinSymptomsLocations")
            ->where([
                "i.symptoms_id" => $symptoms_id, 
                "sl.locations_id in" => $values]
            )
            ->group(["Patients.patients_id"]);
    }


    public function findSearchSymptomsOnry(Query $query, array $options)
    {
        $sub_query = $options["sub_query"];

        return $query
            ->where(["patients_id in" => $sub_query]);
    }

    public function findSearchSickness(Query $query, array $options)
    {
        $values = $options["values"];

        return $query
            ->find("JoinDiseaseds")
            ->where(["d.sicknesses_id in" => $values])
            ->group(["Patients.patients_id"])
            ->order(["Patients.patients_id"]);
    }

    public function findAttributeStatus(Query $query, array $options)
    {
        $patients_id = $options["patients_id"];

        return $query
            ->select([
                "Patients.patients_id", 
                "d.diseaseds_id", 
                "i.interview_symptoms_id", 
                "sl.symptoms_locations_id"
            ])
            ->find("JoinSymptomsLocations", ["d_type" => "LEFT", "i_type" => "LEFT", "sl_type" => "LEFT"])
            ->where([
                "Patients.patients_id" => $patients_id,
                "OR" => [
                    ["d.diseaseds_id is" => NULL],
                    ["i.interview_symptoms_id is" => NULL],
                    ["sl.symptoms_locations_id is" => NULL]
                ]
            ]);
    }

    public function findSicknessRegistrationStatus(Query $query, array $options)
    {
        $patients_id = $options["patients_id"];

        return $query
            ->select(["diseaseds_id"])
            ->find("JoinDiseaseds")
            ->where(["Patients.patients_id" => $patients_id]);
    }

    public function findRelatedSymptomsSub(Query $query, array $options)
    {
        $patients_id = $options["patients_id"];

        return $query
            ->select(["i.symptoms_id"])
            ->find("JoinInterviewSymptoms")
            ->where(["Patients.patients_id" => $patients_id]);
    }

    public function findRelatedSymptoms(Query $query, array $options)
    {
        $patients_id = $options["patients_id"];
        $sub_query = $options["sub_query"];

        return $query
            ->select(["Patients.patients_id", "Patients.pen_name", "i.symptoms_id"])
            ->find("JoinInterviewSymptoms")
            ->where([
                "Patients.patients_id !=" => $patients_id,
                "i.symptoms_id in" => $sub_query
            ])
            ->order(["Patients.patients_id"])
            ->group(["Patients.patients_id, i.symptoms_id"]);
        
    }

    public function findRelatedSicknessSub(Query $query, array $options)
    {
        $patients_id = $options["patients_id"];

        return $query
            ->select(["d.sicknesses_id"])
            ->find("JoinDiseaseds")
            ->where(["Patients.patients_id" => $patients_id]);
    }

    public function findRelatedSickness(Query $query, array $options)
    {
        $patients_id = $options["patients_id"];
        $sub_query = $options["sub_query"];

        return $query
            ->select(["Patients.patients_id", "Patients.pen_name", "d.sicknesses_id"])
            ->find("JoinDiseaseds")
            ->where([
                "Patients.patients_id !=" => $patients_id,
                "d.sicknesses_id in" => $sub_query
            ])
            ->order(["Patients.patients_id"]);
    }

    public function findContainAll(Query $query, array $options)
    {
        return $query
            ->contain([
                "PatientSexes", 
            ])
            ->find("ContainEdit");
    }

    public function findContainEdit(Query $query, array $options)
    {
        return $query
            ->contain([
                "Diseaseds.Sicknesses", 
                "Diseaseds.InterviewSymptoms.Symptoms", 
                "Diseaseds.InterviewSymptoms.SymptomsLocations.Locations"
            ]);
    }

    public function findPatientsDisplayList(Query $query, array $options)
    {
        return $query
            ->find("JoinDiseaseds")
            ->group(["Patients.patients_id"])
            ->contain([
                'PatientSexes', 
                "Diseaseds.Sicknesses",
            ]);
    }

    public function findRecentInterview(Query $query, array $options)
    {
        return $query
            ->select(["patients_id", "pen_name"])
            ->group(["Patients.patients_id"])
            ->order(["modified" => "DESC"])
            ->limit(5);
    }

    /*
     * デフォルトでRIGHT
     */
    public function findJoinDiseaseds(Query $query, array $options)
    {
        $d_type = empty($options["d_type"]) ? "RIGHT" : "LEFT";

        return $query
            ->join([
                "d" => [
                    "table" => "diseaseds",
                    "type" => $d_type,
                    "conditions" => "Patients.patients_id = d.patients_id"
                ],
            ]);
    }

    public function findJoinInterviewSymptoms(Query $query, array $options)
    {
        $d_type = empty($options["d_type"]) ? "RIGHT" : "LEFT";
        $i_type = empty($options["i_type"]) ? "RIGHT" : "LEFT";

        return $query
            ->find("JoinDiseaseds", ["d_type" => $d_type])
            ->join([
                "i" => [
                    "table" => "interview_symptoms",
                    "type" => $i_type,
                    "conditions" => "d.diseaseds_id = i.diseaseds_id"
                ],
            ]);
    }

    public function findJoinSymptomsLocations(Query $query, array $options)
    {
        $d_type = empty($options["d_type"]) ? "RIGHT" : "LEFT";
        $i_type = empty($options["i_type"]) ? "RIGHT" : "LEFT";
        $sl_type = empty($options["sl_type"]) ? "RIGHT" : "LEFT";

        return $query
            ->find("JoinInterviewSymptoms", ["d_type" => $d_type, "i_type" => $i_type])
            ->join([
                "sl" => [
                    "table" => "symptoms_locations",
                    "type" => $sl_type,
                    "conditions" => "i.interview_symptoms_id = sl.interview_symptoms_id"
                ],
            ]);
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('patients_id')
            ->allowEmptyString('patients_id', null, 'create');

        $validator
            ->scalar('pen_name')
            ->maxLength('pen_name', 10)
            ->requirePresence('pen_name', 'create')
            ->notEmptyString('pen_name');

        $validator
            ->integer('age_of_onset')
            ->requirePresence('age_of_onset', 'create')
            ->notEmptyString('age_of_onset');

        $validator
            ->date('year_of_onset')
            ->requirePresence('year_of_onset', 'create')
            ->notEmptyDate('year_of_onset');

        $validator
            ->date('diagnosis_date')
            ->requirePresence('diagnosis_date', 'create')
            ->notEmptyDate('diagnosis_date');

        $validator
            ->date('cured')
            ->allowEmptyDate('cured');

        $validator
            ->scalar('interview_first')
            ->allowEmptyString('interview_first');

        $validator
            ->scalar('interview_second')
            ->allowEmptyString('interview_second');

        $validator
            ->scalar('interview_third')
            ->allowEmptyString('interview_third');

        $validator
            ->scalar('interview_force')
            ->allowEmptyString('interview_force');

        $validator
            ->scalar('other')
            ->allowEmptyString('other');

        return $validator;
    }

    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['patient_sexes_id'], 'PatientSexes'), ['errorField' => 'patient_sexes_id']);
        $rules->add($rules->isUnique(["pen_name"], "このペンネームは登録済みです"));

        return $rules;
    }
}
