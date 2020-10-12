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
        $data = [
            [
                "last_name" => "いとう",
                "first_name" => "としあき",
                "password" => $this->_setPassword("123456"),
                "mail" => "test@test.com",
            ],
            [
                "last_name" => "ながの",
                "first_name" => "めい",
                "password" => $this->_setPassword("123456"),
                "mail" => "test@test.com",
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
