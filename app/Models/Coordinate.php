<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Coordinate
 * 
 * @property int $id
 * @property float $lat
 * @property float $lon
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Coordinate extends Model
{
	const DEFAULT = ['lat' => 55.45, 'lon' => 37.65];
	protected $table = 'coordinates';

	protected $casts = [
		'lat' => 'float',
		'lon' => 'float'
	];

	protected $fillable = [
		'lat',
		'lon'
	];
}
