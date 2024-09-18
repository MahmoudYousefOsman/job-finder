<?php

namespace App\Http\Requests;

use App\Enums\ExperienceLevelEnum;
use App\Enums\WorkTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class JobRequest extends FormRequest
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
            'title' => 'required|string',
            'description' => 'required|string',
            'expired_at' => 'required|date',
            'salary_start' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'location' => 'required|string',
            'experience_leve' => ['required',new Enum(ExperienceLevelEnum::class)],
            'work_type' => ['required', new Enum(WorkTypeEnum::class)],
            'responsibilities' => 'required|string',
            'skills' => ['required','string']
        ];
    }
}
