<?php

namespace App;

use Cartalyst\Sentinel\Users\EloquentUser;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Modules\Core\Entities\HasUuid;
use Modules\Core\Entities\Organization;

class User extends EloquentUser
{
    use Notifiable, SoftDeletes, Authenticatable, CanResetPassword, HasUuid;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'permissions', 'organization_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id', 'password', 'remember_token',
    ];

    public function getFullName()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function hasOrganization()
    {
        return !empty($this->organization_id);
    }

    public function organization() {
        return $this->belongsTo(Organization::class);
    }
}
