<?php

namespace App\Contracts;

use App\Models\Coordinate;
use \Illuminate\Http\Client\Response;

interface WeatherInterface
{
    public function get(Coordinate $coordinate):Response;
}