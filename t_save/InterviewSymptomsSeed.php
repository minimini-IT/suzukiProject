<?php
declare(strict_types=1);

use Migrations\AbstractSeed;

/**
 * InterviewSymptoms seed.
 *
 * patients
 * symptoms
 * 作成後
 *
 */
class InterviewSymptomsSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     *
     * @return void
     */
    public function run()
    {
        $datetime = date("Y-m-d H:i:s");
        $data = [
            [
                "patients_id" => 1,
                "symptoms_id" => 1,
                "created" => $datetime,
                "modified" => $datetime,
            ],
            [
                "patients_id" => 1,
                "symptoms_id" => 2,
                "created" => $datetime,
                "modified" => $datetime,
            ],
            [
                "patients_id" => 2,
                "symptoms_id" => 3,
                "created" => date("Y-m-d", strtotime("+2 month {$datetime}")),
                "modified" => date("Y-m-d", strtotime("+2 month {$datetime}")),
            ],
            [
                "patients_id" => 3,
                "symptoms_id" => 4,
                "created" => date("Y-m-d", strtotime("+3 month {$datetime}")),
                "modified" => date("Y-m-d", strtotime("+3 month {$datetime}")),
            ],
            [
                "patients_id" => 4,
                "symptoms_id" => 2,
                "created" => date("Y-m-d", strtotime("+3 month {$datetime}")),
                "modified" => date("Y-m-d", strtotime("+3 month {$datetime}")),
            ],
            [
                "patients_id" => 4,
                "symptoms_id" => 3,
                "created" => date("Y-m-d", strtotime("+3 month {$datetime}")),
                "modified" => date("Y-m-d", strtotime("+3 month {$datetime}")),
            ],
            [
                "patients_id" => 4,
                "symptoms_id" => 4,
                "created" => date("Y-m-d", strtotime("+3 month {$datetime}")),
                "modified" => date("Y-m-d", strtotime("+3 month {$datetime}")),
            ],
        ];

        $table = $this->table('interview_symptoms');
        $table->insert($data)->save();
    }
}
