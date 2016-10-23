<?php namespace Modules\Core\Entities;

use Faker\Provider\Uuid;

trait HasUuid
{

    public static function bootHasUuid()
    {
        static::creating(function($model){
            $model->uuid = (string) Uuid::uuid();
        });
    }
}
