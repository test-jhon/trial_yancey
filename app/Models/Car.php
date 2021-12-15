<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $table = 'cars';

    protected $guarded = ['id'];

    /**
     * Get the manufacturer associated with car
     */
    public function manufacturer()
    {
        return $this->hasOne('App\Models\Manufacturer', 'id', 'manufacturer_id');
    }

    /**
     * Get the type associated with car
     */
    public function type()
    {
        return $this->hasOne('App\Models\Type', 'id', 'type_id');
    }

    /**
     * Get car colors
     */
    public function colors()
    {
        return $this->hasMany('App\Models\CarColor');
    }
}
