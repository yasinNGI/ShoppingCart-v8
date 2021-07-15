<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Options extends Model
{
    use HasFactory;
    protected $table = "options";
    protected $fillable = ['key' , 'value'];

    public static function add_option($key ,$val){

        if( !isset($key) && !isset($val) )
            return;

        self::updateOrCreate( ['key' => 'cart'] , ['value' => $val] );
    }

}
