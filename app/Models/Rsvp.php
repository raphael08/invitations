<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rsvp extends Model
{
    //
      protected $guarded = [''];

      public function guest(){
   return $this->belongsTo(Guest::class, 'guest_id', 'id');
}
}
