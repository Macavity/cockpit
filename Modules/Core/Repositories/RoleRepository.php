<?php

namespace Modules\Core\Repositories;

use Cartalyst\Sentinel\Roles\EloquentRole;
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

    /**
     * Add Permissions to roles
     *
     * @param array $permissions
     * @param array $permissionsByRole
     * @param string $groupSlug
     */
    public function addPermissionsToRole($permissions, $permissionsByRole, $groupSlug = '')
    {
        foreach($permissionsByRole as $roleSlug => $rolePermissions) {

            /**
             * @var EloquentRole
             */
            $role = Sentinel::findBySlug($roleSlug);

            if($rolePermissions === '*') {
                $rolePermissions = $permissions;
            }

            foreach($rolePermissions as $permissionSlug) {
                $permissionSlug = (empty($groupSlug)) ? $permissionSlug : $groupSlug . '.' . $permissionSlug;
                $role->addPermission($permissionSlug);
            }

            $role->save();

        }
    }

    public function findBySlug($slug)
    {
        return Sentinel::getRoleRepository()->findBySlug($slug);
    }
}
