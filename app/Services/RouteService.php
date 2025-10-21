<?php

namespace App\Services;

use App\Models\Route;
use Illuminate\Support\Facades\DB;

class RouteService
{
    public function getAllRoutes()
    {
        return Route::with('stops', 'contributions')->orderBy('name')->get();
    }

    public function findById(int $id): ?Route
    {
        return Route::with('stops', 'contributions')->findOrFail($id);
    }

    public function create(array $data): Route
    {
        return DB::transaction(function () use ($data) {
            $route = Route::create($data);

            if (isset($data['stops'])) {
                $route->stops()->createMany($data['stops']);
            }

            return $route->load('stops');
        });
    }

    public function update(Route $route, array $data): Route
    {
        return DB::transaction(function () use ($route, $data) {
            $route->update($data);

            if (isset($data['stops'])) {
                $route->stops()->delete();
                $route->stops()->createMany($data['stops']);
            }

            return $route->load('stops');
        });
    }

    public function delete(Route $route): void
    {
        $route->delete();
    }
}
