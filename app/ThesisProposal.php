<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ThesisProposal extends Model
{
    protected $table = 'thesis_proposals';
    protected $guarded = [];

    public function thesess()
    {
        return $this->hasOne(Thesis::class);
    }
}
