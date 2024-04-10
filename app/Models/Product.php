<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // protected $fillable = [
    //     'name',
    //     'description',
    //     'quantity',
    //     'price',
    // ];

    protected $guarded = [];

    public function category(){
        return $this->belongsTo('App\Models\Category');
    }

    public function cat(){
        return $this->hasOne(Category::class, 'id', 'category_id');
    }
}
