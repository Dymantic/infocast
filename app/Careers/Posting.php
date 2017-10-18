<?php

namespace App\Careers;

use Illuminate\Database\Eloquent\Model;

class Posting extends Model
{

    protected $fillable = [
        'title',
        'type',
        'category',
        'location',
        'compensation',
        'posted',
        'start_date',
        'introduction',
        'job_description',
        'responsibilities',
        'requirements'
    ];

    protected $casts = ['published' => 'boolean'];

    protected $dates = ['posted'];

    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    public function receiveApplication($application_details)
    {
        return $this->applications()->create($application_details);
    }

    public function publish()
    {
        $this->published = true;
        $this->save();
    }

    public function retract()
    {
        $this->published = false;
        $this->save();
    }

    public function toJsonableArray()
    {
        return [
            'id'               => $this->id,
            'title'            => $this->title,
            'type'             => $this->type,
            'category'         => $this->category,
            'location'         => $this->location,
            'compensation'     => $this->compensation,
            'posted'           => $this->posted ? $this->posted->format('Y-m-d') : '',
            'start_date'       => $this->start_date,
            'introduction'     => $this->introduction,
            'job_description'  => $this->job_description,
            'responsibilities' => $this->responsibilities,
            'requirements'     => $this->requirements
        ];
    }
}
