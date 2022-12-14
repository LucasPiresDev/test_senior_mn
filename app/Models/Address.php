<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'city_id',
        'street',
        'complement',
        'number',
        'active',
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
