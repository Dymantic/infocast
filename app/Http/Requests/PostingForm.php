<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostingForm extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'title' => 'required|max:255',
            'type' => 'max:255',
            'category' => 'max:255',
            'location' => 'max:255',
            'compensation' => 'max:255',
            'start_date' => 'max:255',
            'posted' => 'date|nullable'
        ];
    }

    public function fields()
    {
        $data = $this->all([
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
        ]);

        $data['posted'] = $this->formatDateString($data['posted']);

        return $data;
    }

    private function formatDateString($date_string)
    {
        if(!$date_string) {
            return null;
        }

        if(strlen($date_string > 10)) {
            return substr($date_string, 0, 10);
        }

        return $date_string;
    }


}
