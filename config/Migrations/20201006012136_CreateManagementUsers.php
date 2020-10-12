<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateManagementUsers extends AbstractMigration
{
    //management_users作成
    public function up()
    {
        $this->table('management_users', ['id' => false, 'primary_key' => ['management_users_id']])
            ->addColumn('management_users_id', 'integer', [
                'autoIncrement' => true,
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('last_name', 'string', [
                'default' => null,
                'limit' => 16,
                'null' => false,
            ])
            ->addColumn('first_name', 'string', [
                'default' => null,
                'limit' => 16,
                'null' => false,
            ])
            ->addColumn('password', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('mail', 'string', [
                'default' => null,
                'limit' => 100,
                'null' => false,
            ])
            ->create();
    }

    public function down()
    {
        $this->table('management_users')->drop()->save();
    }
}
