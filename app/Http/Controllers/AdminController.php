<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Route;
use App\Models\Bus;
use App\Models\Contribution;
use App\Http\Resources\UserResource;
use App\Http\Resources\ContributionResource;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Dashboard metrics
    public function dashboard()
    {
        return response()->json([
            'total_users' => User::count(),
            'total_routes' => Route::count(),
            'active_buses' => Bus::count(),
        ]);
    }

    // List users
    public function users()
    {
        return UserResource::collection(User::all());
    }

    // List contributions
    public function contributions()
    {
        return ContributionResource::collection(Contribution::all());
    }
}