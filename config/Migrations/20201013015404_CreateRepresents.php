<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateRepresents extends AbstractMigration
{
    public function up()
    {
        //represents作成
        $this->table('represents', ['id' => false, 'primary_key' => ['represents_id']])
            ->addColumn('represents_id', 'integer', [
                'autoIncrement' => true,
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('sicknesses_id', 'integer', [
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

        $this->table('represents')
            ->addForeignKey(
                'sicknesses_id',
                'sicknesses',
                'sicknesses_id',
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
            )
            ->update();
    }

    public function down()
    {
        $this->table('represents')
            ->dropForeignKey('sicknesses_id')
            ->dropForeignKey('symptoms_id')
            ->save();
        $this->table('represents')->drop()->save();
    }
}
