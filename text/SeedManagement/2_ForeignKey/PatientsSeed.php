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
                "pen_name" => "テスト",
                "patient_sexes_id" => 1,
                "age_of_onset" => 20,
                "year_of_onset" => "2000/05/01",
                "cured" => "2010/05/01",
                "created" => "2020/10/01",
                "modified" => "2020/10/01",
                "comment" => "治った！！！！！！",
            ],
            /*
            [
                "pen_name" => "ケロケロけろっぴ",
                //"sicknesses_id" => 2,
                "patient_sexes_id" => 2,
                "age_of_onset" => 34,
                "year_of_onset" => "1996/01/01",
                "cured" => "2000/012/01",
                "created" => "2020/10/02",
                "modified" => "2020/10/02",
                "comment" => "うれぴーーー！！",
            ],
            [
                "pen_name" => "元女子高生",
                //"sicknesses_id" => 3,
                "patient_sexes_id" => 3,
                "age_of_onset" => 11,
                "year_of_onset" => "2003/08/01",
                "cured" => null,
                "created" => "2020/10/03",
                "modified" => "2020/10/03",
                "comment" => "治ってないんだなこれが",
            ],
            [
                "pen_name" => "寝てない大学生",
                //"sicknesses_id" => 3,
                "patient_sexes_id" => 1,
                "age_of_onset" => 25,
                "year_of_onset" => "2010/09/01",
                "cured" => null,
                "created" => "2020/10/20",
                "modified" => "2020/10/20",
                "comment" => "もうどうでもいいや",
            ],
             */
        ];

        $table = $this->table('patients');
        $table->insert($data)->save();
    }
}
