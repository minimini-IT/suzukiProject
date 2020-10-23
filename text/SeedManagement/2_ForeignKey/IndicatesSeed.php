<?php
declare(strict_types=1);

use Migrations\AbstractSeed;

/**
 * Indicates seed.
 *
 * symptoms
 * locations
 * の後
 *
 */
class IndicatesSeed extends AbstractSeed
{
    public function run()
    {
        $data = [
            [
                "symptoms_id" => 1,
                "locations_id" => 1
            ],
            [
                "symptoms_id" => 1,
                "locations_id" => 2
            ],
            [
                "symptoms_id" => 2,
                "locations_id" => 3
            ],
            [
                "symptoms_id" => 2,
                "locations_id" => 4
            ],
            [
                "symptoms_id" => 3,
                "locations_id" => 5
            ],
            [
                "symptoms_id" => 4,
                "locations_id" => 1
            ],
            [
                "symptoms_id" => 4,
                "locations_id" => 3
            ],
            [
                "symptoms_id" => 4,
                "locations_id" => 6
            ],
        ];

        $table = $this->table('indicates');
        $table->insert($data)->save();
    }
}
