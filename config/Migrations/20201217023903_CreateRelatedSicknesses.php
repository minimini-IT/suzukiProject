<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateRelatedSicknesses extends AbstractMigration
{
    public function up()
    {
        //related_sicknesses作成
        $this->table('related_sicknesses', ['id' => false, 'primary_key' => ['related_sicknesses_id']])
            ->addColumn('related_sicknesses_id', 'integer', [
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
            ->addColumn('sicknesses_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->create();

        $this->table('related_sicknesses')
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
        $this->table('related_sicknesses')
            ->dropForeignKey('articles_id')
            ->dropForeignKey('sicknesses_id')
            ->save();
        $this->table('related_sicknesses')->drop()->save();
    }
}
