<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'employee_name' => 'required|max:15',
            'qualification' => 'required',
            // 'dob' => ['before_or_equal:' . now()->subYears(18)->format('d-m-Y')],
            'contact_no' => 'nullable|numeric|digits:10|unique:employee_records',
            'departname' => 'required',
            'designation' => 'required',
            'account_no' => 'same:caccount_no',
            'location' => 'required',
            'reportman' => 'required',
            'shift' => 'required',
        ];
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function message()
    {
        return [
            'Aadhar_no.unique'               => 'Aadhar must be unique',
            'pan_no.unique'                  => 'Pan number must be Unique',
            'employment_code.unique'         => 'Pan number must be Unique',
            'contact_no.unique'              => 'Contact number must be Unique',
            'account_no.unique'              => 'Account number must be Unique',
            'account_no.same'                 => 'Account  number And Confirm Account must be same',
            'uan.unique'                      => 'Uan number must be Unique',


        ];
    }
}
