<?php
declare(strict_types=1);

use Migrations\AbstractSeed;

/**
 * RelatedSicknesses seed.
 */
class RelatedSicknessesSeed extends AbstractSeed
{
    public function run()
    {
        $data = [
            [
                "articles_id" => 1,
                "sicknesses_id" => 1
            ],
            [
                "articles_id" => 2,
                "sicknesses_id" => 2
            ],
            [
                "articles_id" => 2,
                "sicknesses_id" => 3
            ],
            [
                "articles_id" => 2,
                "sicknesses_id" => 4
            ],
        ];
        

        $table = $this->table('related_sicknesses');
        $table->insert($data)->save();
    }
}
