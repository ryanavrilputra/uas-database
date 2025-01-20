<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;


class Course extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'courses';
    protected $fillable = ['title', 'description', 'price', 'category_id', 'instructor_id'];
    
    public function category()
    {
        return $this->belongsTo(Categories::class); // Menggunakan Categories
    }
    
    public function instructor()
    {
        return $this->belongsTo(Instructors::class); // Menggunakan Instructors
    }
}
