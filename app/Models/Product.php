<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }
    use HasFactory;

}
