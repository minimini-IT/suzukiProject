<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

//class CreateSymptomsParts extends AbstractMigration
class CreateLocations extends AbstractMigration
{
    //locations作成
    public function up()
    {
        $this->table('locations', ['id' => false, 'primary_key' => ['locations_id']])
            ->addColumn('locations_id', 'integer', [
                'autoIncrement' => true,
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('location', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->create();
    }

    public function down()
    {
        $this->table('locations')->drop()->save();
    }
}
