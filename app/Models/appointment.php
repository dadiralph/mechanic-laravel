<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'date_start',
        'date_end',
        'start_time',
        'end_time',
        'status',
        'appointment_type',
        'reason',
    ];

    public function client()
    {
        return $this->belongsTo('App\Models\User', 'client_id');
    }
    
    public function mechanic()
    {
        return $this->belongsTo('App\Models\User', 'mechanic_id');
    }

    public function appointmentvehicle()
    {
        return $this->hasMany('App\Models\appointmentvehicle', 'appointment_id');
    }

}
