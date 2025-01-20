<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;


class Categories extends Model
{
    
    protected $connection = 'mongodb';
    protected $collection = 'categories';
    protected $fillable = ['name'];
    
    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}
