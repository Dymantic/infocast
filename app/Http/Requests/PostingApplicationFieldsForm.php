<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PostingApplicationFieldsForm extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            '*' => Rule::in(['required', 'optional', 'hidden'])
        ];
    }

    public function updatedFields()
    {
        return $this->only([
            'first_name',
            'last_name',
            'email',
            'phone',
            'contact_method',
            'gender',
            'date_of_birth',
            'prev_company',
            'prev_position',
            'university',
            'qualifications',
            'skills',
            'english_ability',
            'mandarin_ability',
            'notes',
            'avatar',
            'cover_letter',
            'cv'
        ]);
    }
}
