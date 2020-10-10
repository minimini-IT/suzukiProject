<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateBulletinBoards extends AbstractMigration
{
    public function up()
    {
        //bulletin_boards作成
        $this->table('bulletin_boards', ['id' => false, 'primary_key' => ['bulletin_boards_id']])
            ->addColumn('bulletin_boards_id', 'integer', [
                'autoIncrement' => true,
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('title', 'text', [
                'default' => null,
                'null' => false,
            ])
            ->addColumn('author', 'string', [
                'default' => null,
                'limit' => 80,
                'null' => false,
            ])
            ->addColumn('contents', 'text', [
                'default' => null,
                'null' => false,
            ])
            ->create();
    }

    public function down()
    {
        $this->table('bulletin_boards')->drop()->save();
    }
}
