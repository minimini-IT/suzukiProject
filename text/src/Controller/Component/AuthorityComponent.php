<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;

/**
 * Authority component
 */
class AuthorityComponent extends Component
{
    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    public function authorityCheck($entity)
    {
        //権限関係
        $author = [
            "users_id" => $entity->user->users_id,
            "roles_id" => $entity->user->roles_id
        ];
        $operator = [
            "users_id" => $this->request->session()->read("Auth.User.users_id"),
            "roles_id" => $this->request->session()->read("Auth.User.roles_id")
        ];
        //権限があるか
        if($author["users_id"] === $operator["users_id"] || $author["roles_id"] >= $operator["roles_id"]){
            return true;
        }
        return false;
    }

    public function userAuthorityCheck($entity)
    {
        //権限関係
        $author = [
            "users_id" => $entity->users_id,
            "roles_id" => $entity->roles_id
        ];
        $operator = [
            "users_id" => $this->request->session()->read("Auth.User.users_id"),
            "roles_id" => $this->request->session()->read("Auth.User.roles_id")
        ];
        //権限があるか
        if($author["users_id"] === $operator["users_id"] || $author["roles_id"] >= $operator["roles_id"]){
            return true;
        }
        return false;
    }
}
