<?php
declare(strict_types=1);

use Migrations\AbstractSeed;

/**
 * RelatedLocations seed.
 */
class RelatedLocationsSeed extends AbstractSeed
{
    public function run()
    {
        $data = [
            [
                "articles_id" => 1,
                "locations_id" => 3
            ],
            [
                "articles_id" => 2,
                "locations_id" => 2
            ],
            [
                "articles_id" => 2,
                "locations_id" => 2
            ],
            [
                "articles_id" => 2,
                "locations_id" => 3
            ],
            [
                "articles_id" => 2,
                "locations_id" => 4
            ],
        ];

        $table = $this->table('related_locations');
        $table->insert($data)->save();
    }
}
