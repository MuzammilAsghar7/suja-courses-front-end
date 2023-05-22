<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class lesson extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;
    
    protected $fillable = ['title','subtitle','description','status'];
    protected $appends = array('lessonimage');

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

    public function questions(){
        return $this->belongsToMany(question::class);
    }

    public function getLessonimageAttribute()
    {
        //return $this->getMedia('lesson_image');
        $media = $this->getMedia('lesson_image');
        if($media->count() > 0)
        {
            foreach ($media as $detail) {
                return $detail->getUrl();
            }
        }
    }
}
