<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdvisorQuery extends Model
{
    protected $fillable = [
        'farmer_name',
        'contact_number',
        'crop_name',
        'query_text',
        'response_text',
        'status',
    ];
}
