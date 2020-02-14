<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ThesisSupervisor extends Model
{
    public function lecturer(){
        return $this->belongsTo(Lecturer::class,'lecturer_id','id');
    }
}
