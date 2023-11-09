<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;
use App\Models\Coordinate;

/**
 * Class Weather
 *
 * @property int $id
 * @property int $coordinates_id
 * @property string|null $value
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Coordinate $coordinate
 *
 * @package App\Models
 */
class Weather extends Model
{
	protected $table = 'weather';

	protected $casts = [
		'coordinates_id' => 'int'
	];

	protected $fillable = [
		'coordinates_id',
		'value'
	];

	public function coordinate()
	{
		return $this->belongsTo(Coordinate::class, 'coordinates_id');
	}

	/**
	 * @param Coordinate $coordinates
	 *
	 * @return Weather
	 */
	public static function storeDataFromApi(Coordinate $coordinate) : Weather
	{
		$key = env('WEATHER_KEY');
		$response = Http::get('https://api.openweathermap.org/data/2.5/weather', [
			'lat' => $coordinate->lat,
			'lon' => $coordinate->lon,
			'appid' => $key,
			'exclude' => 'current',
			'units' => 'metric'
		]);
		$weather = new Self;
		if ($response->ok()) {
			$weather->coordinates_id = $coordinate->id;
			$weather->value = $response->body();
			$weather->save();

		}
		return $weather;
	}
}
