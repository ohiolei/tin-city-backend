<?php

namespace App\Http\Controllers;

use App\Models\Route;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\RouteService;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\RouteResource;
use App\Http\Requests\StoreRouteRequest;
use App\Http\Requests\UpdateRouteRequest;

class RouteController extends Controller
{
    /**
     * Injecting the RouteService class into the constructor.
     * Then, we have access to the service in whatever methods we need
     */
    private RouteService $route_service;

    public function __construct(RouteService $route_service)
    {
        $this->route_service = $route_service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(
            RouteResource::collection($this->route_service->getAllRoutes()),
            Response::HTTP_OK
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRouteRequest $request)
    {
        $route = $this->route_service->create($request->validated());

        return response()->json(
            new RouteResource($route),
            Response::HTTP_CREATED
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $route = $this->route_service->findById($id);

        return response()->json(
            new RouteResource($route),
            Response::HTTP_OK
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRouteRequest $request, Route $route)
    {
        $updated = $this->route_service->update($route, $request->validated());

        return response()->json(
            new RouteResource($updated),
            Response::HTTP_OK
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Route $route)
    {
        if (!$route) {
            return response()->json(['error' => 'Route not found'], Response::HTTP_NOT_FOUND);
        }

        $this->route_service->delete($route);

        return response()->json(
            ['message' => 'Route deleted successfully'],
            Response::HTTP_OK
        );
    }

    public function export()
    {
        $routes = $this->route_service->getAllRoutes();
        return response()->json([
            'exported_at' => now(),
            'routes' => RouteResource::collection($routes),
        ]);
    }


    // To be removed, used for testing Gate middleware
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (!Auth::attempt($credentials)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $user = Auth::user();
        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
        ]);
    }
}
