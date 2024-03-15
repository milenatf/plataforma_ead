<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\UuidTrait;

class Course extends Model
{
    use HasFactory, UuidTrait;

    protected $fillable = ['name', 'description', 'image'];
}
