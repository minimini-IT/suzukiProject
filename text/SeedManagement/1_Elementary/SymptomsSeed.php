<?php
declare(strict_types=1);

use Migrations\AbstractSeed;

/**
 * Symptoms seed.
 *
 * first
 *
 */
class SymptomsSeed extends AbstractSeed
{
    public function run()
    {
        $data = [
            [
                "symptoms" => "なし",
            ],
            [
                "symptoms" => "腹痛",
            ],
            [
                "symptoms" => "嘔吐",
            ],
            [
                "symptoms" => "めまい",
            ],
            [
                "symptoms" => "吐血",
            ],
        ];

        $table = $this->table('symptoms');
        $table->insert($data)->save();
    }
}
