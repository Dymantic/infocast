<?php

namespace App\Careers;

use Illuminate\Database\Eloquent\Model;

class Posting extends Model
{
    const FIELD_REQUIRED = 'required';
    const FIELD_OPTIONAL = 'optional';
    const FIELD_HIDDEN = 'hidden';

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
        'requirements',
        'application_fields',
        'application_fields->first_name',
        'application_fields->last_name',
        'application_fields->email',
        'application_fields->phone',
        'application_fields->contact_method',
        'application_fields->gender',
        'application_fields->date_of_birth',
        'application_fields->prev_company',
        'application_fields->prev_position',
        'application_fields->university',
        'application_fields->qualifications',
        'application_fields->skills',
        'application_fields->english_ability',
        'application_fields->mandarin_ability',
        'application_fields->notes',
        'application_fields->avatar',
        'application_fields->cover_letter',
        'application_fields->cv'
    ];

    protected $casts = ['published' => 'boolean', 'application_fields' => 'array'];

    protected $dates = ['posted'];

    protected $attributes = [
        'application_fields' => '{}'
    ];

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

    public function setApplicationFields($updated)
    {
        $fields = $this->application_fields;

        foreach($updated as $field => $value) {
            array_set($fields, $field, $value);
        }

        $this->application_fields = $fields;
        $this->save();
    }

    public function applicationFields()
    {
        $defaults = [
            'first_name'       => Posting::FIELD_REQUIRED,
            'last_name'        => Posting::FIELD_REQUIRED,
            'email'            => Posting::FIELD_REQUIRED,
            'phone'            => Posting::FIELD_REQUIRED,
            'contact_method'   => Posting::FIELD_REQUIRED,
            'gender'           => Posting::FIELD_REQUIRED,
            'date_of_birth'    => Posting::FIELD_REQUIRED,
            'prev_company'     => Posting::FIELD_REQUIRED,
            'prev_position'    => Posting::FIELD_REQUIRED,
            'university'       => Posting::FIELD_REQUIRED,
            'qualifications'   => Posting::FIELD_REQUIRED,
            'skills'           => Posting::FIELD_REQUIRED,
            'english_ability'  => Posting::FIELD_REQUIRED,
            'mandarin_ability' => Posting::FIELD_REQUIRED,
            'notes'            => Posting::FIELD_REQUIRED,
            'avatar'           => Posting::FIELD_REQUIRED,
            'cover_letter'     => Posting::FIELD_REQUIRED,
            'cv'               => Posting::FIELD_REQUIRED,
        ];

        $set_fields = $this->application_fields ?: [];

        return array_merge($defaults, $set_fields);
    }
}
