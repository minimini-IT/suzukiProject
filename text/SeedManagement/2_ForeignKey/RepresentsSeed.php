<?php
declare(strict_types=1);

use Migrations\AbstractSeed;

/**
 * Represents seed.
 *
 * sicknesses
 * symptoms
 * の後
 *
 */
class RepresentsSeed extends AbstractSeed
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
                "sicknesses_id" => 1,
                "symptoms_id" => 2
            ],
            [
                "sicknesses_id" => 1,
                "symptoms_id" => 3
            ],
            [
                "sicknesses_id" => 2,
                "symptoms_id" => 1
            ],
            [
                "sicknesses_id" => 2,
                "symptoms_id" => 3
            ],
            [
                "sicknesses_id" => 2,
                "symptoms_id" => 4
            ],
            [
                "sicknesses_id" => 3,
                "symptoms_id" => 4
            ],
            [
                "sicknesses_id" => 4,
                "symptoms_id" => 1
            ],
            [
                "sicknesses_id" => 4,
                "symptoms_id" => 3
            ],
        ];

        $table = $this->table('represents');
        $table->insert($data)->save();
    }
}
