<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateBulletinBoardComments extends AbstractMigration
{
    public function up()
    {
        //bulletin_board_comments作成
        $this->table('bulletin_board_comments', ['id' => false, 'primary_key' => ['bulletin_board_comments_id']])
            ->addColumn('bulletin_board_comments_id', 'integer', [
                'autoIncrement' => true,
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('bulletin_boards_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('comment_author', 'string', [
                'default' => null,
                'limit' => 80,
                'null' => false,
            ])
            ->addColumn('comment_contents', 'text', [
                'default' => null,
                'null' => false,
            ])
            ->create();

        $this->table('bulletin_board_comments')
            ->addForeignKey(
                'bulletin_boards_id',
                'bulletin_boards',
                'bulletin_boards_id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE'
                ]
            )->update();
    }

    public function down()
    {
        $this->table('bulletin_board_comments')
            ->dropForeignKey('bulletin_boards_id')
            ->save();
        $this->table('bulletin_board_comments')->drop()->save();
    }
}
