<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

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

    public function chapters_with_lesson()
    {
        $chapters = $this->hasMany(chapter::class);
        return $chapters->whereHas('lessons_with_question');
    }

    public function questions_id(){
        // $lessons = '';
        $collection = [];
        $chapters = $this->chapters_with_lesson;
        
        foreach($chapters as $chapter){
            $lessons = $chapter->lessons;
            foreach($lessons as $key => $lesson){
                $collection[] = $lesson->questions->pluck('id');
            }
        }
        // return Arr::flatten($lessons);
        //dd($lessons[0]->with('questions'));
        // foreach($lessons as $key => $lesson){
        //     $collection[] = $lesson->questions->pluck('id');
        // }

        $singleArray = Arr::flatten($collection);
        return $singleArray;
    }
}
