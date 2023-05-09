<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

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

}

