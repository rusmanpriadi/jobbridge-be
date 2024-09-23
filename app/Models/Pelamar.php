<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Pelamar extends Model
{
    use HasApiTokens,Notifiable ;

      protected $fillable = ['name', 'nik', 'email', 'password', 'role'];
    protected $hidden = ['password'];
}
