<?php
declare(strict_types=1);

use Migrations\AbstractSeed;
use Cake\Auth\DefaultPasswordHasher;

/**
 * ManagementUsers seed.
 */
class ManagementUsersSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     *
     * @return void
     */
    public function run()
    {
        $datetime = date("Y-m-d H:i:s");
        $data = [
            [
                "last_name" => "admin",
                "first_name" => "admin",
                "password" => $this->_setPassword("Med1CalC0nd1TionE10changE"),
                "mail" => "k66_gunsou777@yahoo.co.jp",
                "created" => $datetime,
                "modified" => $datetime,
            ],
            [
                "last_name" => "いとう",
                "first_name" => "としあき",
                "password" => $this->_setPassword("111111"),
                "mail" => "test@test.com",
                "created" => $datetime,
                "modified" => $datetime,
            ],
            [
                "last_name" => "ながの",
                "first_name" => "めい",
                "password" => $this->_setPassword("222222"),
                "mail" => "asdf@test.com",
                "created" => $datetime,
                "modified" => $datetime,
            ],
        ];

        $table = $this->table('management_users');
        $table->insert($data)->save();
    }

    protected function _setPassword($value)
    {
      $hasher = new DefaultPasswordHasher();
      return $hasher->hash($value);
    }
}
