<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReportRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {

        //dd(request()->all());
        return [
            "campaigns" => [
                'nullable',
                'array',
            ],
            'date_from' => [
                'required',
                // 'date_format: Y-m-d' ,
            ],
            'date_to' => [
                'required',
                // 'date_format: Y-m-d' ,
                'after_or_equal: date_from'
            ],
        ];
    }

    public function attributes(): array
    {
        return [
            "campaigns" => "Campaigns",
            "date_from" => "Date From",
            "date_to" => "Date To",
        ];
    }
}
