<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\Guard;

class Category extends Model
{
    use HasFactory;

    public function products()      {
        return $this->hasMany('App\Models\Product');
    }


    protected $guarded = [];
}
