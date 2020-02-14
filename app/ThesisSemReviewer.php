<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ThesisSemReviewer extends Model
{
    protected $table = 'thesis_sem_reviewers';
    protected $guarded = [];
    
    public function reviewers()
    {
        return $this->hasOne(ThesisSemReviewer::class);
    }
}
