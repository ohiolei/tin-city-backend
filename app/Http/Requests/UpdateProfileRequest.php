<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['nullable', 'string', 'max:255'],
            'dob' => ['nullable', 'date'],
            'gender' => ['nullable', 'in:male,female,other'],
            'phone' => ['nullable', 'string', 'max:20'],
            'location' => ['nullable', 'string', 'max:255'],
            'avatar' => ['nullable', 'file', 'image', 'max:2048'],
        ];
    }

    /**
     * @return array<string, array<string, string>>
     *
     * Describe each body parameter for Scribe documentation.
     */
    public function bodyParameters(): array
    {
        return [
            'name' => [
                'description' => 'The user’s full name.',
                'example' => 'John Doe',
            ],
            'dob' => [
                'description' => 'The user’s date of birth in YYYY-MM-DD format.',
                'example' => '1990-06-15',
            ],
            'gender' => [
                'description' => 'The user’s gender. Allowed values: male, female, other.',
                'example' => 'male',
            ],
            'phone' => [
                'description' => 'The user’s phone number.',
                'example' => '+2348012345678',
            ],
            'location' => [
                'description' => 'The user’s location or address.',
                'example' => 'Lagos, Nigeria',
            ],
            'avatar' => [
                'description' => 'An image file for the user’s avatar.',
                'example' => null,
            ],
        ];
    }
}
