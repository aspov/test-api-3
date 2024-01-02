<?php

namespace App\Services;

use App\Contracts\WeatherInterface;
use App\Models\Coordinate;
use \Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class WeatherDefault implements WeatherInterface
{
    public function get(Coordinate $coordinate): Response
    {
		$response = Http::get('https://api.openweathermap.org/data/2.5/weather', [
			'lat' => $coordinate->lat,
			'lon' => $coordinate->lon,
			'appid' => env('WEATHER_KEY'),
			'exclude' => 'current',
			'units' => 'metric'
		]);
		return $response;
    }
}