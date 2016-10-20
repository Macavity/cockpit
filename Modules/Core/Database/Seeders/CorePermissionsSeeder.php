<?php namespace Modules\Core\Database\Seeders;

use Cartalyst\Sentinel\Roles\EloquentRole;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Modules\Core\Repositories\RoleRepository;
use Sentinel;

class CorePermissionsSeeder extends Seeder
{
    /**
     * @var RoleRepository
     */
    protected $roleRepository;

    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->registerUserPermissions();
        $this->registerOrganizationPermissions();

        Model::reguard();
    }

    public function registerUserPermissions()
    {
        $permissions = [
            'create',
            'read',
            'update',
            'delete',
        ];

        $permissionsByRole = [
            ROLE_ADMIN => '*',
            ROLE_MANAGER => ['read', 'update'],
            ROLE_EMPLOYEE => ['read', 'update']
        ];

        $this->roleRepository->addPermissionsToRole($permissions, $permissionsByRole, 'users');
    }

    public function registerOrganizationPermissions()
    {
        $permissions = [
            'create',
            'read',
            'update',
            'delete',
        ];

        $permissionsByRole = [
            ROLE_ADMIN => '*',
            ROLE_MANAGER => ['read', 'update'],
            ROLE_EMPLOYEE => ['read']
        ];

        $this->roleRepository->addPermissionsToRole($permissions, $permissionsByRole, 'organizations');
    }
}
