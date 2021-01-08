<?php
declare(strict_types=1);

use Migrations\AbstractSeed;

/**
 * RelatedSymptoms seed.
 */
class RelatedSymptomsSeed extends AbstractSeed
{
    public function run()
    {
        $data = [
            [
                "articles_id" => 1,
                "symptoms_id" => 1
            ],
            [
                "articles_id" => 2,
                "symptoms_id" => 2
            ],
            [
                "articles_id" => 2,
                "symptoms_id" => 3
            ],
            [
                "articles_id" => 2,
                "symptoms_id" => 4
            ],
        ];

        $table = $this->table('related_symptoms');
        $table->insert($data)->save();
    }
}
