<?php
declare(strict_types=1);

use Migrations\AbstractSeed;

/**
 * Diseaseds seed.
 *
 * Patients
 * Sicknesses
 * あと作成
 */
class DiseasedsSeed extends AbstractSeed
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
                "patients_id" => 1,
                "sicknesses_id" => 2,
            ],
            /*
            [
                "patients_id" => 2,
                "sicknesses_id" => 2,
            ],
            [
                "patients_id" => 3,
                "sicknesses_id" => 3,
            ],
            [
                "patients_id" => 4,
                "sicknesses_id" => 1,
            ],
            [
                "patients_id" => 4,
                "sicknesses_id" => 4,
            ],
             */
        ];

        $table = $this->table('diseaseds');
        $table->insert($data)->save();
    }
}
