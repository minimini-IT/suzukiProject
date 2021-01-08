<?php
declare(strict_types=1);

use Migrations\AbstractSeed;

/**
 * Articles seed.
 */
class ArticlesSeed extends AbstractSeed
{
    public function run()
    {
        $datetime = date("Y-m-d H:i:s");

        $data = [
            [
                "title" => "テスト記事",
                "contents" => "テスト記事",
                "created" => $datetime,
                "modified" => $datetime,
            ],
            [
                "title" => "記事セカンド",
                "contents" => "あああああああああ",
                "created" => $datetime,
                "modified" => $datetime,
            ],
        ];

        $table = $this->table('articles');
        $table->insert($data)->save();
    }
}
