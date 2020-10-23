<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateDiseaseds extends AbstractMigration
{
    public function up()
    {
        //diseaseds作成
        $this->table('diseaseds', ['id' => false, 'primary_key' => ['diseaseds_id']])
            ->addColumn('diseaseds_id', 'integer', [
                'autoIncrement' => true,
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('patients_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('sicknesses_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->create();

        $this->table('diseaseds')
            ->addForeignKey(
                'patients_id',
                'patients',
                'patients_id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE'
                ]
            )
            ->addForeignKey(
                'sicknesses_id',
                'sicknesses',
                'sicknesses_id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE'
                ]
            )
            ->update();
    }

    public function down()
    {
        $this->table('diseaseds')
            ->dropForeignKey('patients_id')
            ->dropForeignKey('sicknesses_id')
            ->save();
        $this->table('diseaseds')->drop()->save();
    }
}
