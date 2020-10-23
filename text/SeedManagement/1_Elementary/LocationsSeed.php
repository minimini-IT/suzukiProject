<?php
declare(strict_types=1);

use Migrations\AbstractSeed;

/**
 * SymptomsParts seed.
 *
 * first
 *
 */
//class SymptomsPartsSeed extends AbstractSeed
class LocationsSeed extends AbstractSeed
{
    public function run()
    {
        $data = [
            [
                "location" => "脇腹"
            ],
            [
                "location" => "胃"
            ],
            [
                "location" => "みぞおち"
            ],
            [
                "location" => "胸"
            ],
            [
                "location" => "肩"
            ],
            [
                "location" => "背中"
            ],
            [
                "location" => "喉"
            ],
            [
                "location" => "指"
            ],
        ];

        $table = $this->table('locations');
        $table->insert($data)->save();
    }
}
