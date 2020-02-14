<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ThesisSeminar extends Model
{
    protected $table = 'thesis_seminars';
    protected $guarded = [];

    public function thesess()
    {
        return $this->hasOne(Thesis::class);
    }
    public function reviewers()
    {
        return $this->hasMany(ThesisSemReviewer::class);
    }
    public function seminar_audiences()
    {
        return $this->hasMany(ThesisSemAudience::class,'thesis_seminar_id','id');
    }   
}
