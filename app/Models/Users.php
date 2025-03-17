<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Users extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'users';
    protected $fillable = ['full_name','email','password','remember_token'];

}
