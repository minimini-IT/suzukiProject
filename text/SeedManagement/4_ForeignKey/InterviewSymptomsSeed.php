<?php
declare(strict_types=1);

use Migrations\AbstractSeed;

/**
 * InterviewSymptoms seed.
 *
 * diseaseds
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
        $data = [
            [
                "diseaseds_id" => 1,
                "symptoms_id" => 1,
            ],
            [
                "diseaseds_id" => 1,
                "symptoms_id" => 2,
            ],
            /*
            [
                "diseaseds_id" => 2,
                "symptoms_id" => 3,
            ],
            [
                "diseaseds_id" => 3,
                "symptoms_id" => 4,
            ],
            [
                "diseaseds_id" => 4,
                "symptoms_id" => 2,
            ],
            [
                "diseaseds_id" => 4,
                "symptoms_id" => 3,
            ],
            [
                "diseaseds_id" => 4,
                "symptoms_id" => 4,
            ],
             */
        ];

        $table = $this->table('interview_symptoms');
        $table->insert($data)->save();
    }
}
