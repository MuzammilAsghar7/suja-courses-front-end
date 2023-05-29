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
    protected $appends = array('questionimage');
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
    public function getQuestionimageAttribute()
    {
        $media = $this->getMedia('question_image');
        if($media->count() > 0)
        {
            foreach ($media as $detail) {
                return $detail->getUrl();
            }
        }
    } 
}

