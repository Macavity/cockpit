<?php

namespace Modules\Core\Repositories;

use App\Company;
use App\User;

class UserRepository
{
    public function all()
    {
        return User::all();
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

    public function companyEmployees(Company $company)
    {
        return $company->users();
    }
}
