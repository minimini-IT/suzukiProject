<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateRelatedLocations extends AbstractMigration
{
    public function up()
    {
        //related_locations作成
        $this->table('related_locations', ['id' => false, 'primary_key' => ['related_locations_id']])
            ->addColumn('related_locations_id', 'integer', [
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
            ->addColumn('locations_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->create();

        $this->table('related_locations')
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
        $this->table('related_locations')
            ->dropForeignKey('articles_id')
            ->dropForeignKey('locations_id')
            ->save();
        $this->table('related_locations')->drop()->save();
    }
}
