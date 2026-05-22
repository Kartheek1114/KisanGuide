<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Crop extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'description',
        'optimal_temp_min',
        'optimal_temp_max',
        'optimal_humidity_min',
        'optimal_humidity_max',
        'optimal_ph_min',
        'optimal_ph_max',
        'optimal_n',
        'optimal_p',
        'optimal_k',
        'soil_types',
        'water_requirement',
        'harvest_days',
        'image_url',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'soil_types' => 'array',
            'optimal_temp_min' => 'float',
            'optimal_temp_max' => 'float',
            'optimal_humidity_min' => 'float',
            'optimal_humidity_max' => 'float',
            'optimal_ph_min' => 'float',
            'optimal_ph_max' => 'float',
            'optimal_n' => 'integer',
            'optimal_p' => 'integer',
            'optimal_k' => 'integer',
            'harvest_days' => 'integer',
        ];
    }
}
