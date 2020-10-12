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
            ],
            [
                "title" => "俺たちの今後は",
                "author" => "ボブ",
                "contents" => "AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKK",
            ],
            [
                "title" => "YOASOBI",
                "author" => "スチュアート",
                "contents" => "王",
            ],
        ];

        $table = $this->table('bulletin_boards');
        $table->insert($data)->save();
    }
}
