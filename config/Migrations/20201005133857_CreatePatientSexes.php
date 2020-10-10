<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreatePatientSexes extends AbstractMigration
{
    public function up()
    {
        //patients作成
        $this->table('patient_sexes', ['id' => false, 'primary_key' => ['patient_sexes_id']])
            ->addColumn('patient_sexes_id', 'integer', [
                'autoIncrement' => true,
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('patient_sex', 'string', [
                'default' => null,
                'limit' => 16,
                'null' => false,
            ])
            ->create();
    }

    public function down()
    {
        $this->table('patient_sexes')->drop()->save();
    }
}
