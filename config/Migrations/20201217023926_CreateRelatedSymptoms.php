<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateRelatedSymptoms extends AbstractMigration
{
    public function up()
    {
        //related_symptoms作成
        $this->table('related_symptoms', ['id' => false, 'primary_key' => ['related_symptoms_id']])
            ->addColumn('related_symptoms_id', 'integer', [
                'autoIncrement' => true,
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('articles_id', 'integer', [
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

        $this->table('related_symptoms')
            ->addForeignKey(
                'articles_id',
                'articles',
                'articles_id',
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
        $this->table('related_symptoms')
            ->dropForeignKey('articles_id')
            ->dropForeignKey('symptoms_id')
            ->save();
        $this->table('related_symptoms')->drop()->save();
    }
}
