<?php

namespace Modules\Core\Repositories;

use App\User;
use Modules\Core\Entities\Organization;
use Sentinel;

class OrganizationRepository
{
    public function all(User $user)
    {
        $isAdmin = $user->inRole(ROLE_ADMIN);
        $isManager = $user->inRole(ROLE_MANAGER);
        $isClient = $user->inRole(ROLE_EMPLOYEE);

        if($isAdmin) {
            return Organization::all();
        }
        else {
            return Organization::find($user->company_id);
        }

    }

    /**
     * @return \App\User|null
     */
    public function currentUser()
    {
        if(\Sentinel::check()) {
            return User::find(\Sentinel::getUser()->getUserId());
        }
        return null;
    }

    public function companyEmployees(Organization $organization)
    {
        return $organization->users();
    }
}
