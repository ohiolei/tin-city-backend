<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Temporarily comment out the constructor
    // public function __construct()
    // {
    //     $this->middleware(['auth:sanctum', 'admin']);
    // }

    public function index()
    {
        return response()->json(['message' => 'Welcome to the admin dashboard.'], 200);
    }
}