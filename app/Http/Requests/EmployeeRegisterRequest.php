<?php

namespace App\Http\Requests;

use App\Enums\UserTypeEnum;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EmployeeRegisterRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users,email,' . auth()->id(),
            'password' => [Rule::when($this->method() == 'POST', ['required'], ['nullable']), 'string', 'confirmed'],
            'phone' => 'required|string|numeric|unique:users,phone,' . auth()->id(),
            'type' => '',
            'image' => [Rule::when($this->method() == 'POST', ['required'], ['nullable']), 'image', 'mimes:jpeg,png,jpg,gif,svg,webp', 'max:2048'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'type' => UserTypeEnum::Employee->value,
        ]);
    }
}
