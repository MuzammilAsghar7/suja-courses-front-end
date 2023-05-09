<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class module extends Model
{
    use HasFactory;
    
    public function courses()   
    {
        return $this->hasMany(course::class);
    } 
    public function chapters()
    {
        return $this->hasMany(chapter::class);
    }
}
