<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Producteur extends Model
{
    use HasApiTokens, HasFactory, Notifiable;


    protected $fillable = [
        'name',
        'email',
        'password',
        'business_name',
        'phone',
        'loction_id',
        'adress',
        'casier',
        'bio',
        'description'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
