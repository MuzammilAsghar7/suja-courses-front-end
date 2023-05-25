<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Image\Manipulations;
use Illuminate\Support\Arr;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class lesson extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;
    
    protected $fillable = ['title','subtitle','description','status', 'icon', 'parent','multiple'];
    protected $appends = array('lessonimage', 'lessonname');

    public function registerMediaConversions(Media $media = null): void
    {
        $this
            ->addMediaConversion('preview')
            ->fit(Manipulations::FIT_CROP, 300, 300)
            ->nonQueued();
    }

    public function chapter(){
        return $this->belongsToMany(chapter::class);
    }

    public function children() {
        return $this->hasMany($this,'parent');
    }
    public function children_question_ids(){
        $lessons = $this->children;
        $collection = [];
        foreach($lessons as $key => $lesson){
            $collection[] = $lesson->questions->pluck('id');
        }
        $singleArray = Arr::flatten($collection);
        return $singleArray;
    }
    public function parent() {
        return $this->belongsTo($this,'parent');
    }
    public function questions(){
        return $this->belongsToMany(question::class);
    }

    public function questionscount(){
        return $this->questions()->count();
    }
    public function questionsattempcount(){
        return Attempt::where(['user_id' => auth()->user()->id,'lesson_id'=> $this->id])->count();
    }

    public function getLessonnameAttribute(){
        return $this->where('id', $this->parent)->first();
    }
    
    public function getLessonimageAttribute()
    {
        $media = $this->getMedia('lesson_image');
        if($media->count() > 0)
        {
            foreach ($media as $detail) {
                return $detail->getUrl();
            }
        }
    }
}
