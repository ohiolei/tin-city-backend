<?php

namespace App\Http\Controllers;

use App\Models\Badge;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class BadgeController extends Controller
{
    /**
     * Display a listing of the badges.
     */
    public function index(): JsonResponse
    {
        $badges = Badge::all();
        return response()->json($badges);
    }

    /**
     * Store a newly created badge in storage.
     * 
     * @throws ValidationException
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'points_required' => 'required|integer|min:0',
            'icon' => 'nullable|string',
        ]);

        $badge = Badge::create($validated);
        return response()->json($badge, 201);
    }

    /**
     * Display the specified badge.
     */
    public function show(Badge $badge): JsonResponse
    {
        return response()->json($badge);
    }

    /**
     * Update the specified badge in storage.
     * 
     * @throws ValidationException
     */
    public function update(Request $request, Badge $badge): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'points_required' => 'sometimes|required|integer|min:0',
            'icon' => 'nullable|string',
        ]);

        $badge->update($validated);
        return response()->json($badge);
    }

    /**
     * Remove the specified badge from storage.
     */
    public function destroy(Badge $badge): JsonResponse
    {
        $badge->delete();
        return response()->json(null, 204);
    }
}