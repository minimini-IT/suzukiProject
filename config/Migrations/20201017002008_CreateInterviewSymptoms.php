<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateInterviewSymptoms extends AbstractMigration
{
    public function up()
    {
        //interview_symptoms作成
        $this->table('interview_symptoms', ['id' => false, 'primary_key' => ['interview_symptoms_id']])
            ->addColumn('interview_symptoms_id', 'integer', [
                'autoIncrement' => true,
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            /*
            ->addColumn('patients_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
             */
            ->addColumn('diseaseds_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('symptoms_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->create();

        $this->table('interview_symptoms')
            ->addForeignKey(
                'diseaseds_id',
                'diseaseds',
                'diseaseds_id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE'
                ]
            )
            ->addForeignKey(
                'symptoms_id',
                'symptoms',
                'symptoms_id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE'
                ]
            )->update();
    }

    public function down()
    {
        $this->table('interview_symptoms')
            ->dropForeignKey('diseaseds_id')
            ->dropForeignKey('symptoms_id')
            ->save();
        $this->table('interview_symptoms')->drop()->save();
    }
}
