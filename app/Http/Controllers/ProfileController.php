<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * @group Profile Management
 *
 * APIs for managing user profiles
 */
class ProfileController extends Controller
{
    /**
     * Display the authenticated user's profile.
     *
     * @group Profile Management
     */
    public function show(): UserResource
    {
        return new UserResource(auth()->user());
    }

    /**
     * Update the authenticated user's profile.
     *
     * @bodyParam name string optional The user's full name.
     * @bodyParam dob date optional Date of birth (YYYY-MM-DD).
     * @bodyParam gender string optional One of: male, female, other.
     * @bodyParam phone string optional User's phone number.
     * @bodyParam location string optional User's location.
     * @bodyParam avatar file optional Avatar image file.
     */
    public function update(UpdateProfileRequest $request): UserResource
    {
        $user = auth()->user();
        $data = $request->validated();

        // Handle S3 avatar upload
        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->storePublicly('avatars', 's3');
            $data['avatar'] = Storage::disk('s3')->url($path);
        }

        $user->update($data);

        return new UserResource($user);
    }
}
