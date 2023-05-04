<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class chapter extends Model
{
    use HasFactory;
    protected $fillable = ['name','title','module_id','icon','subtitle','description'];
    public function module()
    {
        return $this->belongsTo(module::class,'module_id');
    }
    public function lessons(){
        return $this->belongsToMany(lesson::class);
    }
}
