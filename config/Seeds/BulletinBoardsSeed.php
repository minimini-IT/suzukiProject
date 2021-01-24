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
        $datetime = date("Y-m-d H:i:s");

        $data = [
            [
                "title" => "例の病気について",
                "author" => "ケビン",
                "contents" => "あああああああああああああああああああああああああああああああああああああああああああああああ。",
                "created" => date("Y-m-d H:i:s", strtotime("-3 month")),
                "modified" => date("Y-m-d H:i:s", strtotime("-1 month")),
            ],
            [
                "title" => "俺たちの今後は",
                "author" => "ボブ",
                "contents" => "AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKK",
                "created" => date("Y-m-d H:i:s", strtotime("-2 month")),
                "modified" => date("Y-m-d H:i:s", strtotime("-2 month")),
            ],
            [
                "title" => "YOASOBI",
                "author" => "スチュアート",
                "contents" => "王",
                "created" => $datetime,
                "modified" => $datetime,
            ],
        ];

        $table = $this->table('bulletin_boards');
        $table->insert($data)->save();
    }
}
