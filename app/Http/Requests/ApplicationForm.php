<?php

namespace App\Http\Requests;

use App\Careers\ApplicationUpload;
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
        return [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email',
            'phone' => 'required|max:255',
            'contact_method' => ['required', Rule::in(['email', 'phone'])],
            'gender' => ['required', Rule::in(['female', 'male'])],
            'date_of_birth' => 'required|max:255',
            'prev_company' => 'required|max:255',
            'prev_position' => 'required|max:255',
            'university' => 'required|max:255',
            'english_ability' => ['required', Rule::in(['poor', 'intermediate', 'excellent'])],
            'mandarin_ability' => ['required', Rule::in(['poor', 'intermediate', 'excellent'])],
            'qualifications' => 'required',
            'skills' => 'required',
            'avatar' => 'nullable|exists:application_uploads,file_id',
            'cover_letter' => 'nullable|exists:application_uploads,file_id',
            'cv' => 'nullable|exists:application_uploads,file_id'
        ];
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
        if($this->avatar) {
            $file = ApplicationUpload::byFileId($this->avatar);
            $data['avatar'] = $file->id ?? null;
        }

        if($this->cover_letter) {
            $file = ApplicationUpload::byFileId($this->cover_letter);
            $data['cover_letter'] = $file->id ?? null;
        }

        if($this->cv) {
            $file = ApplicationUpload::byFileId($this->cv);
            $data['cv'] = $file->id ?? null;
        }

        return $data;
    }
}
