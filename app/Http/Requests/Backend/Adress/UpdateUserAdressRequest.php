<?php

namespace App\Http\Requests\Backend\Adress;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserAdressRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:200|unique:user_adresses,name,' . request()->segments()[2],
            'email' => 'required|email',
            'phone' => 'required|numeric|max_digits:10',
            'country' => 'required|max:200',
            'state' => 'required|max:200',
            'city' => 'required|max:200',
            'zip_code' => 'required',
            'adress' => 'required',
        ];
    }
}
