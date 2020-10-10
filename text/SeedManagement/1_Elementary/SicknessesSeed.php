<?php
declare(strict_types=1);

use Migrations\AbstractSeed;

/**
 * Sicknesses seed.
 *
 * first
 *
 */
class SicknessesSeed extends AbstractSeed
{
    public function run()
    {
        $data = [
            [
                "sickness_name" => "がん",
            ],
            [
                "sickness_name" => "生活習慣病",
            ],
            [
                "sickness_name" => "心筋梗塞",
            ],
            [
                "sickness_name" => "肺炎",
            ],
        ];

        $table = $this->table('sicknesses');
        $table->insert($data)->save();
    }
}
