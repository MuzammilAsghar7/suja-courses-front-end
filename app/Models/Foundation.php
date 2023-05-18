<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Foundation extends Model
{
    use HasFactory;
    protected $fillable =  ['user_id','question_id','answer','reference','thoughts'];

    public function formatdate($createdDate)
    {
        $date = Carbon::parse($createdDate)->format('jS F Y (h:i)');
        return $date;
    }
}
