<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreatePatients extends AbstractMigration
{
    public function up()
    {
        //patients作成
        $this->table('patients', ['id' => false, 'primary_key' => ['patients_id']])
            ->addColumn('patients_id', 'integer', [
                'autoIncrement' => true,
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('pen_name', 'string', [
                'default' => null,
                'limit' => 100,
                'null' => false,
            ])
            ->addColumn('patient_sexes_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('age_of_onset', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('year_of_onset', 'date', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('cured', 'date', [
                'default' => null,
                'null' => true,
            ])
            ->addColumn('comment', 'text', [
                'default' => null,
                'null' => true,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'null' => false,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'null' => false,
            ])
            ->create();

        $this->table('patients')
            ->addForeignKey(
                'patient_sexes_id',
                'patient_sexes',
                'patient_sexes_id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE'
                ]
            )->update();
    }

    public function down()
    {
        $this->table('patients')
            ->dropForeignKey('patient_sexes_id')
            ->save();
        $this->table('patients')->drop()->save();
    }
}
