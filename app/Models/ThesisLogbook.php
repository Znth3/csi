<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ThesisLogbook extends Model
{
    public static $validation_rules = [
        'supervisor_id' => 'required',
        'date' => 'required',
        'progress'  => 'required',
        'status' => 'required'
    ];

    public static $status = [
        0 => 'Submitted',
        1 => 'OK',
        2 => 'Not OK'
    ];

    protected $dates = ['date'];

    protected $fillable = [
        'thesis_id',
        'supervisor_id',
        'date',
        'progress',
        'file_progress',
        'status'
    ];

    public function thesis(){
        return $this->belongsTo(Thesis::class,'thesis_id','id');
    }

    public function supervisor(){
        return $this->belongsTo(ThesisSupervisor::class,'supervisor_id','id');
    }

    public static function thesisLogbookList(int $thesis_id,int $count){
        $thesisLogbooks = self::where('thesis_id',$thesis_id)
            ->paginate($count);
        $thesisLogbooks->each(function ($thesisLogbook){
            return $thesisLogbook->status = self::$status[$thesisLogbook->status];
        });
        return $thesisLogbooks;
    }
}
