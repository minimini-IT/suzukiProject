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
