<?php
use Migrations\AbstractSeed;

/**
 * Ranks seed.
 */
class RanksSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'rank' => '１等空佐',
                'abb_rank' => '１佐',
                'rank_sort_number' => '1',
            ],
            [
                'rank' => '２等空佐',
                'abb_rank' => '２佐',
                'rank_sort_number' => '2',
            ],
            [
                'rank' => '３等空佐',
                'abb_rank' => '３佐',
                'rank_sort_number' => '3',
            ],
            [
                'rank' => '１等空尉',
                'abb_rank' => '１尉',
                'rank_sort_number' => '4',
            ],
            [
                'rank' => '２等空尉',
                'abb_rank' => '２尉',
                'rank_sort_number' => '5',
            ],
            [
                'rank' => '３等空尉',
                'abb_rank' => '３尉',
                'rank_sort_number' => '6',
            ],
            [
                'rank' => '空曹長',
                'abb_rank' => '曹長',
                'rank_sort_number' => '7',
            ],
            [
                'rank' => '１等空曹',
                'abb_rank' => '１曹',
                'rank_sort_number' => '8',
            ],
            [
                'rank' => '２等空曹',
                'abb_rank' => '２曹',
                'rank_sort_number' => '9',
            ],
            [
                'rank' => '３等空曹',
                'abb_rank' => '３曹',
                'rank_sort_number' => '10',
            ],
            [
                'rank' => '空士長',
                'abb_rank' => '士長',
                'rank_sort_number' => '11',
            ],
            [
                'rank' => '１等空士',
                'abb_rank' => '１士',
                'rank_sort_number' => '12',
            ],
            [
                'rank' => '２等空士',
                'abb_rank' => '２士',
                'rank_sort_number' => '13',
            ],
        ];

        $table = $this->table('ranks');
        $table->insert($data)->save();
    }
}
