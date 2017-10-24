<?php

namespace App\Http\Requests;

use App\Careers\ApplicationUpload;
use App\Careers\Posting;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ApplicationForm extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {

        $base_rules = [
            'first_name'       => ['max:255'],
            'last_name'        => ['max:255'],
            'email'            => ['email', 'nullable'],
            'phone'            => ['max:255'],
            'contact_method'   => [Rule::in(['email', 'phone']), 'nullable'],
            'gender'           => [Rule::in(['female', 'male']), 'nullable'],
            'date_of_birth'    => ['max:255'],
            'prev_company'     => ['max:255'],
            'prev_position'    => ['max:255'],
            'university'       => ['max:255'],
            'english_ability'  => [Rule::in(['poor', 'intermediate', 'excellent']), 'nullable'],
            'mandarin_ability' => [Rule::in(['poor', 'intermediate', 'excellent']), 'nullable'],
            'qualifications'   => [],
            'skills'           => [],
            'notes'            => [],
            'avatar'           => ['nullable', 'exists:application_uploads,file_id'],
            'cover_letter'     => ['nullable', 'exists:application_uploads,file_id'],
            'cv'               => ['nullable', 'exists:application_uploads,file_id']
        ];

        $required_fields = collect($this->posting->applicationFields())->filter(function ($field) {
            return $field === Posting::FIELD_REQUIRED;
        })->all();

        return collect($base_rules)->flatMap(function ($rules, $field) use ($required_fields) {
            if (array_key_exists($field, $required_fields)) {
                return [$field => array_merge($rules, ['required'])];
            }

            return [$field => $rules];
        })->all();


    }

    public function fields()
    {
        $form_fields = [
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
            'english_ability',
            'mandarin_ability',
            'qualifications',
            'skills',
            'notes',
            'avatar',
            'cover_letter',
            'cv'
        ];

        $data = $this->all($form_fields);

        return $this->withUploadFileIds($data);
    }

    private function withUploadFileIds(&$data)
    {
        if ($this->avatar) {
            $file = ApplicationUpload::byFileId($this->avatar);
            $data['avatar'] = $file->id ?? null;
        }

        if ($this->cover_letter) {
            $file = ApplicationUpload::byFileId($this->cover_letter);
            $data['cover_letter'] = $file->id ?? null;
        }

        if ($this->cv) {
            $file = ApplicationUpload::byFileId($this->cv);
            $data['cv'] = $file->id ?? null;
        }

        return $data;
    }
}
