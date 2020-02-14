<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ThesisSemAudience extends Model
{
    protected $table = 'thesis_sem_audiences';
    protected $guarded = [];

    public function seminars()
    {
        return $this->hasOne(ThesisSeminar::class);
    }
}
