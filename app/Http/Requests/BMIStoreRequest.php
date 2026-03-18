<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * BMI Store Request
 * @author Victor Ramos <httpsvictorramos@gmail.com>
 * @since 10/03/2026
 */
class BMIStoreRequest extends FormRequest
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
            "height" => 'required|numeric|min:0.1|decimal:2',
            "weight" => 'required|numeric|min:0.1|decimal:2'
        ];
    }
}
