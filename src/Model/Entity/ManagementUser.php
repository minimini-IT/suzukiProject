<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\Entity;
use Authentication\IdentityInterface;

class ManagementUser extends Entity implements IdentityInterface
{
    protected $_accessible = [
        "management_users_id" => true,
        'last_name' => true,
        'first_name' => true,
        'password' => true,
        'mail' => true,
    ];

    /*
    protected $_hidden = [
        'password',
    ];
     */

    protected function _setPassword($password)
    {
        if(strlen($password) > 0)
        {
            return(new DefaultPasswordHasher)->hash($password);
        }
    }

    /*
     * 承認用２つ
     */
    public function getIdentifier()
    {
        return $this->management_users_id;
    }

    public function getOriginalData()
    {
        return $this;
    }
}
