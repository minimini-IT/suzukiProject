<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateSymptoms extends AbstractMigration
{
    //symptoms作成
    public function up()
    {
        $this->table('symptoms', ['id' => false, 'primary_key' => ['symptoms_id']])
            ->addColumn('symptoms_id', 'integer', [
                'autoIncrement' => true,
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('symptoms', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->create();
    }

    public function down()
    {
        $this->table('symptoms')->drop()->save();
    }
}
