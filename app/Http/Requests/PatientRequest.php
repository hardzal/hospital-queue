<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PatientRequest extends FormRequest
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
            'name' => 'required|min:2',
            'gender' => 'required',
            'email' => 'required|email',
            'no_hp' => 'required|min:10|max:13'
        ];
    }

    /**
     * Detail of the messages required
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Nama wajib diisi!',
            'gender.required' => 'Jenis Kelamin wajib diisi!',
            'email.required' => 'Email wajib diisi!',
            'no_hp.min' => 'Minimal 10 karakter untuk No Hp',
            'no_hp.max' => 'Maksimal 13 karakter untuk No Hp'
        ];
    }
}
