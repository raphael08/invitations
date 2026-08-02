<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Event;
class Guest extends Model
{
    //

    protected $guarded = [''];
    public static function generateCode($length)
{
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    $code = '';

    for ($i = 0; $i < $length; $i++) {
        $code .= $characters[random_int(0, strlen($characters) - 1)];
    }

    return $code;
}

public function event(){
    return $this->belongsTo(Event::class);
}
public function response(){
    return $this->hasOne(Rsvp::class,'guest_id','id');
}


}
