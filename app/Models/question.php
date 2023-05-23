<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Carbon\Carbon;


class question extends Model implements HasMedia
{
    use HasFactory,InteractsWithMedia;
    protected $fillable = ['title','content'];
    public function registerMediaConversions(Media $media = null): void
    {
        $this
            ->addMediaConversion('preview')
            ->fit(Manipulations::FIT_CROP, 300, 300)
            ->nonQueued();
    }
    public function lesson(){
        return $this->belongsToMany(lesson::class);
    }
    public function qtype(){
        return $this->belongsToMany(qtype::class);
    }
    public function qoptions(){
        return $this->hasMany(qoption::class);
    }
    public function checkuserAns($question_id)
    {
        $attempt = Attempt::where(['user_id'=> auth()->user()->id, 'question_id' => $question_id])->first();
        echo '<h1>';
        print_r($question_id);
        echo '</h1>';
        if($attempt){
            return true;
        } else{
            return false;
        }
    }

    public function foundation($question_id)
    {
        $foundationsGet = Foundation::where(['user_id'=> auth()->user()->id, 'question_id' => $question_id])->get();
        if($foundationsGet){
            return $foundationsGet;
        } else{
            return false;
        }
    }    
}

