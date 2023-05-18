<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class qoption extends Model
{
    use HasFactory;
    protected $fillable = ['question_id', 'title', 'status'];

    public function checkCorrectOption($option_id)
    {
        
    }
    
}
