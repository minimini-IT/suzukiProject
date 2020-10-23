<?php
declare(strict_types=1);

use Migrations\AbstractSeed;

/**
 * BulletinBoardComments seed.
 *
 * BuletinBoardsのデータを入れた後
 *
 */
class BulletinBoardCommentsSeed extends AbstractSeed
{
    public function run()
    {
        $data = [
            [
                "bulletin_boards_id" => 1,
                "comment_author" => "はげまんと",
                "comment_contents" => "なはなはなはなはなはなはなはなはなは",
                "created" => "2020/10/01",
                "modified" => "2020/10/01"
            ],
            [
                "bulletin_boards_id" => 1,
                "comment_author" => "鬼サイボーグ",
                "comment_contents" => "けらけらケセラセラ",
                "created" => "2020/10/01",
                "modified" => "2020/10/01"
            ],
            [
                "bulletin_boards_id" => 2,
                "comment_author" => "永野芽衣",
                "comment_contents" => "動かざること山のごとし",
                "created" => "2020/10/05",
                "modified" => "2020/10/05",
            ],
        ];

        $table = $this->table('bulletin_board_comments');
        $table->insert($data)->save();
    }
}
