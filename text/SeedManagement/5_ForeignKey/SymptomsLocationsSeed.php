<?php
declare(strict_types=1);

use Migrations\AbstractSeed;

/**
 * InterviewLocations seed.
 */
//class InterviewLocationsSeed extends AbstractSeed
class SymptomsLocationsSeed extends AbstractSeed
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
                "interview_symptoms_id" => 1,
                "locations_id" => 2,
            ],
            [
                "interview_symptoms_id" => 2,
                "locations_id" => 4,
            ],
            [
                "interview_symptoms_id" => 3,
                "locations_id" => 5,
            ],
            [
                "interview_symptoms_id" => 4,
                "locations_id" => 1,
            ],
            [
                "interview_symptoms_id" => 4,
                "locations_id" => 6,
            ],
            [
                "interview_symptoms_id" => 5,
                "locations_id" => 2,
            ],
            [
                "interview_symptoms_id" => 5,
                "locations_id" => 8,
            ],
            [
                "interview_symptoms_id" => 6,
                "locations_id" => 4,
            ],
            [
                "interview_symptoms_id" => 6,
                "locations_id" => 7,
            ],
            [
                "interview_symptoms_id" => 7,
                "locations_id" => 3,
            ],
            [
                "interview_symptoms_id" => 7,
                "locations_id" => 6,
            ],
            [
                "interview_symptoms_id" => 7,
                "locations_id" => 8,
            ],
        ];

        $table = $this->table('symptoms_locations');
        $table->insert($data)->save();
    }
}
