<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateInstructorRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'email' => ['required', 'email', Rule::unique('instructors')->ignore($this->instructor)],
            'password' => 'nullable|min:8',
            'phone' => ['required', 'numeric', Rule::unique('instructors')->ignore($this->instructor), 'digits:11'],
            'age' => 'numeric|nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:5048',
            'subCategories' => 'required',
        ];
    }
}
