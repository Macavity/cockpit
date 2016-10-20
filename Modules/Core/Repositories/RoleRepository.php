<?php

namespace Modules\Core\Repositories;

use Sentinel;

class RoleRepository
{
    public function all() {

        $currentUser = Sentinel::getUser();

        if($currentUser->inRole(ROLE_ADMIN)){
            return [
                ROLE_ADMIN => Sentinel::getRoleRepository()->findBySlug(ROLE_ADMIN),
                ROLE_MANAGER => Sentinel::getRoleRepository()->findBySlug(ROLE_MANAGER),
                ROLE_EMPLOYEE => Sentinel::getRoleRepository()->findBySlug(ROLE_EMPLOYEE),
            ];
        }
        else {
            return [
                ROLE_MANAGER => Sentinel::getRoleRepository()->findBySlug(ROLE_MANAGER),
                ROLE_EMPLOYEE => Sentinel::getRoleRepository()->findBySlug(ROLE_EMPLOYEE),
            ];
        }

    }

    public function addUserToRole(){

    }
}
