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
        $datetime = date("Y-m-d H:i:s");

        $data = [
            [
                "bulletin_boards_id" => 1,
                "comment_author" => "はげまんと",
                "comment_contents" => "なはなはなはなはなはなはなはなはなは",
                "created" => date("Y-m-d H:i:s", strtotime("-2 month")),
                "modified" => date("Y-m-d H:i:s", strtotime("-2 month")),
            ],
            [
                "bulletin_boards_id" => 1,
                "comment_author" => "鬼サイボーグ",
                "comment_contents" => "けらけらケセラセラ",
                "created" => date("Y-m-d H:i:s", strtotime("-2 month 3 day")),
                "modified" => date("Y-m-d H:i:s", strtotime("-2 month 3 day")),
            ],
            [
                "bulletin_boards_id" => 2,
                "comment_author" => "永野芽衣",
                "comment_contents" => "動かざること山のごとし",
                "created" => date("Y-m-d H:i:s", strtotime("-1 month")),
                "modified" => date("Y-m-d H:i:s", strtotime("-1 month")),
            ],
        ];

        $table = $this->table('bulletin_board_comments');
        $table->insert($data)->save();
    }
}
