<?php

namespace App\Http\Controllers;

use App\Models\Weather;
use App\Http\Resources\WeatherResource;
use App\Http\Resources\WeatherResourceCollection;
use Illuminate\Http\JsonResponse;
use App\Models\Coordinate;
use App\Services\WeatherDefault;

class WeatherController extends Controller
{

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json(['success' => true, 'data' => new WeatherResourceCollection(Weather::orderByDesc('created_at')->paginate())]);
    }

    /**
     * @return JsonResponse
     */
    public function updateDefault(): JsonResponse
    {
        $coordinates = Coordinate::firstOrCreate(Coordinate::DEFAULT);
        $weather = Weather::storeFromApi($coordinates, new WeatherDefault);
        return response()->json(['success' => true, 'data' => new WeatherResource($weather)]);
    }
}
