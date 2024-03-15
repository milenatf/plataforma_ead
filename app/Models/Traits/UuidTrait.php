<?php

namespace App\Models\Traits;

use Illuminate\Support\Str;

trait UuidTrait
{
    public static function booted()
    {
        static::creating(function ($model) {
            // dd($model->getKeyName());
            $model->{$model->getKeyName()} = (String) Str::uuid();
        });
    }
}