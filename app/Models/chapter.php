<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class chapter extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = ['name','title','module_id','icon','subtitle','description', 'parent'];
    protected $appends = array('chapterimage');

    public function registerMediaConversions(Media $media = null): void
    {
        $this
            ->addMediaConversion('preview')
            ->fit(Manipulations::FIT_CROP, 300, 300)
            ->nonQueued();
    }

    public function getChapterimageAttribute()
    {
        $media = $this->getMedia('chapter_image');
        if($media->count() > 0)
        {
            foreach ($media as $detail) {
                return $detail->getUrl();
            }
        }
    }

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
    public function children_question_ids(){
        
        $lessons = $this->lessons;
        $collection = [];
        foreach($lessons as $key => $lesson){
            $childrens = $lesson->children;
            foreach($childrens as $key => $children){
                $collection[] = $children->questions->pluck('id');
            }
        }
        $singleArray = Arr::flatten($collection);
        return $singleArray;
    }

}
