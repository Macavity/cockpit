<?php

namespace Modules\Core\Database\Seeders;

use App\User;
use Activation;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Core\Entities\Organization;
use Modules\Core\Repositories\RoleRepository;
use Sentinel;

class CoreTestUserSeeder extends Seeder
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

        $this->addTestAdmin();
        $this->addTestOrganization();

        Model::reguard();

    }

    private function addTestAdmin()
    {
        $admin = factory(User::class)->create([
            'first_name' => 'Test',
            'last_name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => app('hash')->make('admin'),
        ]);

        $admin->save();

        $adminRole = $this->roleRepository->findBySlug(ROLE_ADMIN);
        $adminRole->users()->attach($admin);

        // Activate User
        $this->forceActivation($admin);

    }

    private function addTestOrganization()
    {
        $company = factory(Organization::class)->create();

        $managerRole = $this->roleRepository->findBySlug('manager');

        // A Test Manager
        $manager = factory(User::class)->create([
            'organization_id' => $company->id,
            'email' => 'manager@example.com',
            'password' => app('hash')->make('manager'),
        ]);
        $company->users()->save($manager);
        $managerRole->users()->attach($manager);

        // Activate Manager
        $this->forceActivation($manager);

        // 1 Test User for this company, with a known password
        factory(User::class, 1)->create([
            'organization_id' => $company->id,
            'email' => 'user@example.com',
            'password' => app('hash')->make('user'),
        ])->each(function(User $user) {
            $employeeRole = Sentinel::getRoleRepository()->findBySlug('employee');
            $employeeRole->users()->attach($user);

            $this->forceActivation($user);
        });

        // 48 other test users for this company
        factory(User::class, 48)->create([
            'organization_id' => $company->id,
        ])->each(function(User $user) {
            $employeeRole = Sentinel::getRoleRepository()->findBySlug('employee');
            $employeeRole->users()->attach($user);
        });

    }

    private function forceActivation($user) {
        // Check activation
        if(Activation::completed($user)){
            return;
        }

        // Activate User
        if(!$activation = Activation::exists($user)) {
            $activation = Activation::create($user);
        }
        Activation::complete($user, $activation->code);
    }
}
