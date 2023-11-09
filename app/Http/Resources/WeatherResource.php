<?php

namespace App\Http\Resources;

use Countable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WeatherResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        if ($this->resource instanceof Countable) {
            foreach ($this->resource as $resource) {
                $resource->value = json_decode($resource->value)->main;
            }
        } else {
            $this->resource->value = json_decode($this->resource->value)->main;
        }

        return parent::toArray($request);
    }
}
