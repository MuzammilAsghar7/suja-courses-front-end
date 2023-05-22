<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
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

    public function lessons_with_question(){
        return $this->belongsToMany(lesson::class)->whereHas('questions');
    }

    // public function lessons_question_count(){
    //     return Attempt::where(['user_id'=> auth()->user()->id, 'lesson_id'=> $this->lessons->id])->get();
    // }
    public function questions_id(){
        $lessons = $this->lessons;
        $collection = [];
        foreach($lessons as $key => $lesson){
            $collection[] = $lesson->questions->pluck('id');
        }

        $singleArray = Arr::flatten($collection);

        return $singleArray;
    }
}
