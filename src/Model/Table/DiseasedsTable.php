<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
class DiseasedsTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('diseaseds');
        $this->setDisplayField('diseaseds_id');
        $this->setPrimaryKey('diseaseds_id');

        $this->belongsTo('Patients', [
            'foreignKey' => 'patients_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Sicknesses', [
            'foreignKey' => 'sicknesses_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany("InterviewSymptoms", [
            'foreignKey' => 'diseaseds_id',
            'joinType' => 'INNER',
        ]);
    }
    
    public function findRelatedArticlesLocationsSub(Query $query, array $options)
    {
        $patients_id = $options["patients_id"];

        return $query
            ->select(["sl.locations_id"])
            ->find("JoinSymptomsLocations")
            ->where(["patients_id" => $patients_id]);
    }

    public function findRelatedArticlesSymptomsSub(Query $query, array $options)
    {
        $patients_id = $options["patients_id"];

        return $query
            ->select(["i.symptoms_id"])
            ->find("JoinInterviewSymptoms")
            ->where(["patients_id" => $patients_id]);
    }

    public function findPatientSicknesses(Query $query, array $options)
    {
        $patients_id = $options["patients_id"];

        return $query
            ->select(["sicknesses_id"])
            ->where(["patients_id" => $patients_id]);
    }

    public function findPatientsSickCount(Query $query, array $options)
    {
        $patients_id = $options["patients_id"];

        return $query
            ->select(["sicknesses_id"])
            ->where(["patients_id" => $patients_id]);
    }

    public function findTableSicknessRow(Query $query, array $options)
    {
        $patients_id = $options["patients_id"];

        return $query
            ->select(["count_locations_id" => "count(sl.locations_id)"])
            ->find("JoinSymptomsLocations")
            ->where(["patients_id" => $patients_id])
            ->group(["Diseaseds.diseaseds_id"]);

    }

    /*
     * デフォルトでRIGHT
     */
    public function findJoinInterviewSymptoms(Query $query, array $options)
    {
        $i_type = empty($options["i_type"]) ? "RIGHT" : "LEFT";

        return $query
            ->join([
                "i" => [
                    "table" => "interview_symptoms",
                    "type" => $i_type,
                    "conditions" => "Diseaseds.diseaseds_id = i.diseaseds_id"
                ],
            ]);
    }

    public function findJoinSymptomsLocations(Query $query, array $options)
    {
        $i_type = empty($options["i_type"]) ? "RIGHT" : "LEFT";
        $sl_type = empty($options["sl_type"]) ? "RIGHT" : "LEFT";

        return $query
            ->find("JoinInterviewSymptoms", ["i_type" => $i_type])
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
            ->integer('diseaseds_id')
            ->allowEmptyString('diseaseds_id', null, 'create');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['patients_id'], 'Patients'), ['errorField' => 'patients_id']);
        $rules->add($rules->existsIn(['sicknesses_id'], 'Sicknesses'), ['errorField' => 'sicknesses_id']);

        return $rules;
    }
}
