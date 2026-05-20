<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pest extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'target_crops',
        'humidity_threshold',
        'temp_threshold',
        'symptoms',
        'prevention_measures',
        'remedial_measures',
        'severity_level',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'target_crops' => 'array',
            'humidity_threshold' => 'float',
            'temp_threshold' => 'float',
        ];
    }
}
