<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateIndicates extends AbstractMigration
{
    public function up()
    {
        //indecates作成
        $this->table('indicates', ['id' => false, 'primary_key' => ['indicates_id']])
            ->addColumn('indicates_id', 'integer', [
                'autoIncrement' => true,
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('symptoms_id', 'integer', [
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

        $this->table('indicates')
            ->addForeignKey(
                'symptoms_id',
                'symptoms',
                'symptoms_id',
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
            )
            ->update();
    }

    public function down()
    {
        $this->table('indicates')
            ->dropForeignKey('symptoms_id')
            ->dropForeignKey('locations_id')
            ->save();
        $this->table('indicates')->drop()->save();
    }
}
