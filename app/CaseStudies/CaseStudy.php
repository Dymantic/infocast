<?php

namespace App\CaseStudies;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Carbon;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class CaseStudy extends Model implements HasMedia
{
    use Sluggable, HasMediaTrait;

    const TITLE_IMAGES = 'title_images';
    const BODY_IMAGES = 'body_images';

    protected $fillable = [
        'title',
        'project_type',
        'time_period',
        'client'
    ];

    protected $dates = ['published_on'];

    protected $casts = ['is_draft' => 'bool'];


    public function sluggable(): array
    {
        return [
            'slug' => [
                'source'   => 'title',
                'onUpdate' => !$this->hasBeenPublished()
            ]
        ];
    }

    public function publish()
    {
        $this->published_on = Carbon::today();
        $this->is_draft = false;
        $this->save();
    }

    public function retract()
    {
        $this->is_draft = true;
        $this->save();
    }

    public function hasBeenPublished()
    {
        return !is_null($this->published_on);
    }

    public function setBody($content)
    {
        $this->body = $content;
        $this->save();
    }

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('banner')
             ->fit(Manipulations::FIT_MAX, 1400, 1000)
             ->optimize()
             ->performOnCollections(static::TITLE_IMAGES);

        $this->addMediaConversion('web')
             ->fit(Manipulations::FIT_MAX, 800, 600)
             ->optimize()
             ->performOnCollections(static::TITLE_IMAGES, static::BODY_IMAGES);

        $this->addMediaConversion('thumb')
             ->fit(Manipulations::FIT_CROP, 400, 300)
             ->optimize()
             ->performOnCollections(static::TITLE_IMAGES, static::BODY_IMAGES);
    }

    public function setTitleImage(UploadedFile $image)
    {
        $this->clearTitleImage();
        return $this
            ->addMedia($image)
            ->preservingOriginal()
            ->toMediaCollection(static::TITLE_IMAGES);
    }

    public function clearTitleImage()
    {
        $this->clearMediaCollection(static::TITLE_IMAGES);
    }
}
