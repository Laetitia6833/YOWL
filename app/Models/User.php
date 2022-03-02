<?php

namespace App\Models;

use App\Models\Location;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = ['name', 'email', 'password'];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}
