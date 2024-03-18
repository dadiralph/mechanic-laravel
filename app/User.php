<?php

namespace App;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable 
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'displayName', 'email', 'localId', 'profileURL', 'notifications'
     ];
     public function getAuthIdentifierName() {
        return 'localId';
     }
     public function getAuthIdentifier(){
        return $this->localId;
     }
}
