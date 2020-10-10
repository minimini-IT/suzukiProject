<?php
declare(strict_types=1);

use Migrations\AbstractSeed;

/**
 * Patients seed.
 *
 * Sicknesses
 * PatientSexes
 * の後
 *
 */
class PatientsSeed extends AbstractSeed
{
    public function run()
    {
        $data = [
            [
                "patients_initial" => "K Y",
                "sicknesses_id" => 1,
                "patient_sexes_id" => 1,
                "age_of_onset" => 20,
                "year_of_onset" => "2000/05/01",
                "cured" => "2010/05/01",
                "comment" => "治った！！！！！！",
            ],
            [
                "patients_initial" => "H H",
                "sicknesses_id" => 2,
                "patient_sexes_id" => 2,
                "age_of_onset" => 34,
                "year_of_onset" => "1996/01/01",
                "cured" => "2000/012/01",
                "comment" => "うれぴーーー！！",
            ],
            [
                "patients_initial" => "J K",
                "sicknesses_id" => 3,
                "patient_sexes_id" => 3,
                "age_of_onset" => 11,
                "year_of_onset" => "2003/08/01",
                "cured" => null,
                "comment" => "治ってないんだなこれが",
            ],
        ];

        $table = $this->table('patients');
        $table->insert($data)->save();
    }
}
