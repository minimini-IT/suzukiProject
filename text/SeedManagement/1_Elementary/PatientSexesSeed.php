<?php
declare(strict_types=1);

use Migrations\AbstractSeed;

/**
 * PatientSexes seed.
 *
 * first
 *
 */
class PatientSexesSeed extends AbstractSeed
{
    public function run()
    {
        $data = [
            [
                "patient_sex" => "男性",
            ],
            [
                "patient_sex" => "女性",
            ],
            [
                "patient_sex" => "その他",
            ],
        ];

        $table = $this->table('patient_sexes');
        $table->insert($data)->save();
    }
}
