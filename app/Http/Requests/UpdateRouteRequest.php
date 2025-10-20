<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRouteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['sometimes', 'string', 'max:255'],
            'start_point' => ['sometimes', 'string', 'max:255'],
            'end_point' => ['sometimes', 'string', 'max:255'],
            'encoded_polyline' => ['sometimes', 'string'],
            'distance_km' => ['sometimes', 'numeric', 'min:0'],
            'stops' => ['sometimes', 'array'],
            'stops.*.name' => ['required_with:stops', 'string'],
            'stops.*.latitude' => ['required_with:stops', 'numeric'],
            'stops.*.longitude' => ['required_with:stops', 'numeric'],
            'stops.*.order_index' => ['required_with:stops', 'integer'],
        ];
    }
}
