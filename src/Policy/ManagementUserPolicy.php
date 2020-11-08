<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\ManagementUser;
use Authorization\IdentityInterface;

class ManagementUserPolicy
{
    //public function canCreate(IdentityInterface $user, ManagementUsers $managementUsers)
    public function canAdd(IdentityInterface $user, ManagementUser $managementUser)
    {
        return true;
    }

    public function canIndex(IdentityInterface $user, ManagementUser $managementUser)
    {
        return true;
    }

    //public function canUpdate(IdentityInterface $user, ManagementUsers $managementUsers)
    public function canEdit(IdentityInterface $user, ManagementUser $managementUser)
    {
        //return true;
        return $this->isAuthor($user, $managementUser);
    }

    public function canDelete(IdentityInterface $user, ManagementUser $managementUser)
    {
        return $this->isAuthor($user, $managementUser);
    }

    public function canView(IdentityInterface $user, ManagementUser $managementUser)
    {
        return $managementUser->management_users_id === $user->getIdentifier();
    }

    protected function isAuthor(IdentityInterface $user, ManagementUser $managementUser)
    {
        return $managementUser->management_users_id === $user->getIdentifier() || $user->getIdentifier() === 1;
    }
}
