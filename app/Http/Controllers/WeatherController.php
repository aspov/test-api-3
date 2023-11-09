<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWeatherRequest;
use App\Models\Weather;
use App\Http\Resources\WeatherResource;
use Illuminate\Http\JsonResponse;
use App\Models\Coordinate;

class WeatherController extends Controller
{

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json(['success' => true, 'data' => new WeatherResource(Weather::orderByDesc('created_at')->paginate())]);
    }

    /**
     * @return JsonResponse
     */
    public function updateDefault(): JsonResponse
    {
        $coordinates = Coordinate::firstOrCreate(Coordinate::DEFAULT);
        $weather = Weather::storeDataFromApi($coordinates);
        return response()->json(['success' => true, 'data' => new WeatherResource($weather)]);
    }
}
