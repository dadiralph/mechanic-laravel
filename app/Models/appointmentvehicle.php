<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class appointmentvehicle extends Model
{
    use HasFactory;

    public function vehicleservice()
    {
        return $this->hasMany('App\Models\vehicleservice', 'appointment_vehicle_id');
    }
    
}
