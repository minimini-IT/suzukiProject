<?php
use Migrations\AbstractSeed;
use Cake\Auth\DefaultPasswordHasher;

/**
 * Users seed.
 */
class UsersSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'users_id' => '1',
                'belongs_id' => '4',
                'ranks_id' => '11',
                'roles_id' => '1',
                'username' => '999999',
                'first_name' => '管理',
                'last_name' => '太郎',
                "password" => $this->_setPassword("csesqadmin"),
                'user_sort_number' => '1',
                'delete_flag' => '0',
            ],
            [
                'users_id' => '2',
                'belongs_id' => '4',
                'ranks_id' => '4',
                'roles_id' => '1',
                'username' => '189737',
                'first_name' => '菅内',
                'last_name' => '雅',
                "password" => $this->_setPassword(123456),
                'user_sort_number' => '2',
                'delete_flag' => '0',
            ],
            [
                'users_id' => '3',
                'belongs_id' => '4',
                'ranks_id' => '4',
                'roles_id' => '4',
                'username' => '206946',
                'first_name' => '鹿子木',
                'last_name' => '知宏',
                "password" => $this->_setPassword(123456),
                'user_sort_number' => '3',
                'delete_flag' => '0',
            ],
            [
                'users_id' => '4',
                'belongs_id' => '4',
                'ranks_id' => '4',
                'roles_id' => '4',
                'username' => '197193',
                'first_name' => '木村',
                'last_name' => '武志',
                "password" => $this->_setPassword(123456),
                'user_sort_number' => '4',
                'delete_flag' => '0',
            ],
            [
                'users_id' => '5',
                'belongs_id' => '4',
                'ranks_id' => '5',
                'roles_id' => '4',
                'username' => '234500',
                'first_name' => '松島',
                'last_name' => '知史',
                "password" => $this->_setPassword(123456),
                'user_sort_number' => '5',
                'delete_flag' => '0',
            ],
            [
                'users_id' => '6',
                'belongs_id' => '4',
                'ranks_id' => '5',
                'roles_id' => '4',
                'username' => '233995',
                'first_name' => '村上',
                'last_name' => '弘',
                "password" => $this->_setPassword(123456),
                'user_sort_number' => '6',
                'delete_flag' => '0',
            ],
            [
                'users_id' => '7',
                'belongs_id' => '4',
                'ranks_id' => '5',
                'roles_id' => '4',
                'username' => '207937',
                'first_name' => '田中',
                'last_name' => '信行',
                "password" => $this->_setPassword(123456),
                'user_sort_number' => '7',
                'delete_flag' => '0',
            ],
            [
                'users_id' => '8',
                'belongs_id' => '4',
                'ranks_id' => '7',
                'roles_id' => '4',
                'username' => '188573',
                'first_name' => '鎌田',
                'last_name' => '林太郎',
                "password" => $this->_setPassword(123456),
                'user_sort_number' => '8',
                'delete_flag' => '0',
            ],
            [
                'users_id' => '9',
                'belongs_id' => '4',
                'ranks_id' => '9',
                'roles_id' => '4',
                'username' => '219955',
                'first_name' => '作本',
                'last_name' => '安章',
                "password" => $this->_setPassword(123456),
                'user_sort_number' => '9',
                'delete_flag' => '0',
            ],
            [
                'users_id' => '10',
                'belongs_id' => '4',
                'ranks_id' => '10',
                'roles_id' => '4',
                'username' => '224378',
                'first_name' => '荒畑',
                'last_name' => '真央',
                "password" => $this->_setPassword(123456),
                'user_sort_number' => '10',
                'delete_flag' => '0',
            ],
            [
                'users_id' => '11',
                'belongs_id' => '4',
                'ranks_id' => '11',
                'roles_id' => '1',
                'username' => '231616',
                'first_name' => '伊藤',
                'last_name' => '肇亮',
                "password" => $this->_setPassword("MiNi_0ns"),
                'user_sort_number' => '11',
                'delete_flag' => '0',
            ],
            [
                'users_id' => '12',
                'belongs_id' => '4',
                'ranks_id' => '11',
                'roles_id' => '4',
                'username' => '244176',
                'first_name' => '森下',
                'last_name' => '裕也',
                "password" => $this->_setPassword(123456),
                'user_sort_number' => '12',
                'delete_flag' => '0',
            ],
            [
                'users_id' => '13',
                'belongs_id' => '4',
                'ranks_id' => '11',
                'roles_id' => '4',
                'username' => '250482',
                'first_name' => '宮城',
                'last_name' => '雄太',
                "password" => $this->_setPassword(123456),
                'user_sort_number' => '13',
                'delete_flag' => '0',
            ],
            [
                'users_id' => '14',
                'belongs_id' => '4',
                'ranks_id' => '11',
                'roles_id' => '4',
                'username' => '249291',
                'first_name' => '伊藤',
                'last_name' => '雄太',
                "password" => $this->_setPassword(123456),
                'user_sort_number' => '14',
                'delete_flag' => '0',
            ],
            [
                'users_id' => '15',
                'belongs_id' => '4',
                'ranks_id' => '11',
                'roles_id' => '4',
                'username' => '249538',
                'first_name' => '小林',
                'last_name' => '祟弘',
                "password" => $this->_setPassword(123456),
                'user_sort_number' => '15',
                'delete_flag' => '0',
            ],
            [
                'users_id' => '16',
                'belongs_id' => '4',
                'ranks_id' => '11',
                'roles_id' => '4',
                'username' => '251081',
                'first_name' => '新藏',
                'last_name' => '幸大',
                "password" => $this->_setPassword(123456),
                'user_sort_number' => '16',
                'delete_flag' => '0',
            ],
            [
                'users_id' => '17',
                'belongs_id' => '4',
                'ranks_id' => '11',
                'roles_id' => '4',
                'username' => '251218',
                'first_name' => '前田',
                'last_name' => '唯',
                "password" => $this->_setPassword(123456),
                'user_sort_number' => '17',
                'delete_flag' => '0',
            ],
        ];


        $table = $this->table('users');
        $table->insert($data)->save();
    }

    protected function _setPassword($value){
        $hasher = new DefaultPasswordHasher();
        return $hasher->hash($value);
    }
}
