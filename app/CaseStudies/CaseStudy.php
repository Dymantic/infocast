<?php

namespace App\CaseStudies;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Carbon;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class CaseStudy extends Model implements HasMedia
{
    use Sluggable, InteractsWithMedia;

    const TITLE_IMAGES = 'title_images';
    const BODY_IMAGES = 'body_images';

    protected $fillable = [
        'title',
        'project_type',
        'time_period',
        'client',
        'intro',
        'description',
        'body'
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

    public function registerMediaConversions(Media $media = null): void
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

    public function addBodyImage(UploadedFile $image)
    {
        return $this
            ->addMedia($image)
            ->preservingOriginal()
            ->toMediaCollection(static::BODY_IMAGES);
    }

    public function toArray()
    {
        $title_img = $this->getFirstMedia(static::TITLE_IMAGES);
        return [
            'id' => $this->id,
            'title' => $this->title,
            'client' => $this->client,
            'project_type' => $this->project_type,
            'time_period' => $this->time_period,
            'intro' => $this->intro,
            'description' => $this->description,
            'body' => $this->body,
            'published_on' => $this->hasBeenPublished() ? $this->published_on->format('F j, Y') : null,
            'is_draft' => $this->is_draft,
            'title_image_thumb' => $title_img ? $title_img->getUrl('thumb') : null,
            'title_image_web' => $title_img ? $title_img->getUrl('web') : null,
            'title_image_banner' => $title_img ? $title_img->getUrl('banner') : null,
        ];
    }
}
