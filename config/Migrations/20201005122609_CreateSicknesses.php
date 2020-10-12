<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateSicknesses extends AbstractMigration
{
    public function up()
    {
        //sicknesses作成
        $this->table('sicknesses', ['id' => false, 'primary_key' => ['sicknesses_id']])
            ->addColumn('sicknesses_id', 'integer', [
                'autoIncrement' => true,
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('sickness_name', 'string', [
                'default' => null,
                'limit' => 80,
                'null' => false,
            ])
            ->create();
    }

    public function down()
    {
        $this->table('sicknesses')->drop()->save();
    }
}
