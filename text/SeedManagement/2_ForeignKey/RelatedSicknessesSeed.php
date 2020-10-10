<?php
declare(strict_types=1);

use Migrations\AbstractSeed;

/**
 * RelatedSicknesses seed.
 *
 * sicknesses作成後
 *
 */
class RelatedSicknessesSeed extends AbstractSeed
{
    public function run()
    {
        $data = [
            [
                "sicknesses_id" => 1,
                "related_number" => 1,
            ],
            [
                "sicknesses_id" => 2,
                "related_number" => 2,
            ],
            [
                "sicknesses_id" => 3,
                "related_number" => 2,
            ],
            [
                "sicknesses_id" => 4,
                "related_number" => 1,
            ],
        ];

        $table = $this->table('related_sicknesses');
        $table->insert($data)->save();
    }
}
