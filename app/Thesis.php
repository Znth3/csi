<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thesis extends Model
{
    protected $table = 'theses';
    protected $guarded = [];

    public function seminars()
    {
        return $this->hasMany(ThesisSeminar::class);
    }

    public function proposals()
    {
        return $this->hasMany(ThesisProposal::class);
    }
}
