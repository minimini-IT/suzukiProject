<?php
declare(strict_types=1);

use Migrations\AbstractSeed;

/**
 * BulletinBoards seed.
 *
 * first
 *
 */
class BulletinBoardsSeed extends AbstractSeed
{
    public function run()
    {
        $data = [
            [
                "title" => "例の病気について",
                "author" => "ケビン",
                "contents" => "あああああああああああああああああああああああああああああああああああああああああああああああ。",
                "created" => "2020/10/01",
                "modified" => "2020/10/01"
            ],
            [
                "title" => "俺たちの今後は",
                "author" => "ボブ",
                "contents" => "AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKK",
                "created" => "2020/10/05",
                "modified" => "2020/10/05",
            ],
            [
                "title" => "YOASOBI",
                "author" => "スチュアート",
                "contents" => "王",
                "created" => "2020/10/11",
                "modified" => "2020/10/11",
            ],
        ];

        $table = $this->table('bulletin_boards');
        $table->insert($data)->save();
    }
}
