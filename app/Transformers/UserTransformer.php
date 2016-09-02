<?php

namespace App\Transformers;

use App\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    public function transform(User $user)
    {
        return [
            'uuid'=> $user->uuid,
            'name'=> $user->name,
            'email'=> $user->email,
            'active'=> (bool) $user->active,
            'last_login'=> (string) $user->last_login,
            'last_password_change'=> (string) $user->last_password_change,
            'deleted_at'=> (string) $user->deleted_at,
            'created_at'=> (string) $user->created_at,
            'updated_at'=> (string) $user->updated_at,
            'links' => [
                [
                    'rel' => 'self',
                    'uri' => '/users/'.$user->uuid,
                ]
            ]
        ];
    }
}

// \* @property .*\$([a-z_]+) => '$1' => \$item->$1,
