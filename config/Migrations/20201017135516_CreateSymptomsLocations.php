<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

//class CreateInterviewLocations extends AbstractMigration
class CreateSymptomsLocations extends AbstractMigration
{
    public function up()
    {
        //symptoms_locations作成
        $this->table('symptoms_locations', ['id' => false, 'primary_key' => ['symptoms_locations_id']])
            ->addColumn('symptoms_locations_id', 'integer', [
                'autoIncrement' => true,
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('interview_symptoms_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('locations_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->create();

        $this->table('symptoms_locations')
            ->addForeignKey(
                'interview_symptoms_id',
                'interview_symptoms',
                'interview_symptoms_id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE'
                ]
            )
            ->addForeignKey(
                'locations_id',
                'locations',
                'locations_id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE'
                ]
            )->update();
    }

    public function down()
    {
        $this->table('symptoms_locations')
            ->dropForeignKey('interview_symptoms_id')
            ->dropForeignKey('locations_id')
            ->save();
        $this->table('symptoms_locations')->drop()->save();
    }
}
