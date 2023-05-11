<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lesson extends Model
{
    use HasFactory;
    protected $fillable = ['title','subtitle','description','status'];
    public function chapter(){
        return $this->belongsToMany(chapter::class);
    }

    public function questions(){
        return $this->belongsToMany(question::class);
    }
}
