<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;


class Instructors extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'instructors';
    protected $fillable = ['name', 'email', 'expertise'];
    
    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}
