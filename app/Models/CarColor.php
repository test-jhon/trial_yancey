<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarColor extends Model
{
    use HasFactory;

    protected $table = 'car_colors';

    protected $guarded = ['id'];

    /**
     * Get car colors
     */
    public function color()
    {
        return $this->hasOne('App\Models\CarColor');
    }
}
