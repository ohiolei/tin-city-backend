<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRouteRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Restrict to admin later via middleware if needed
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'start_point' => ['required', 'string', 'max:255'],
            'end_point' => ['required', 'string', 'max:255'],
            'encoded_polyline' => ['required', 'string'],
            'distance_km' => ['required', 'numeric', 'min:0'],
            'stops' => ['sometimes', 'array'],
            'stops.*.name' => ['required_with:stops', 'string'],
            'stops.*.latitude' => ['required_with:stops', 'numeric'],
            'stops.*.longitude' => ['required_with:stops', 'numeric'],
            'stops.*.order_index' => ['required_with:stops', 'integer'],
        ];
    }
}
