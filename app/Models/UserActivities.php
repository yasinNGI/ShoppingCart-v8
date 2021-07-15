<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserActivities extends Model
{
    use HasFactory;
    public $table = 'user_activities';
    protected $fillable = ['user_id', 'name' , 'email' , 'login_time' , 'logout_time' , 'total_hours'];
}
