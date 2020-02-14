<?php

namespace App\Models;

use App\ThesisTopic;
use Illuminate\Database\Eloquent\Model;

class Thesis extends Model
{
        public static $validation_rules = [
            'thesis_id' =>'required',
            'student_id' => 'required',
            'title' => 'required',
            'abstract'  => 'required',
            'start_at' => 'required',
            'status' => 'required'
        ];

        public static $status = [
            0 => 'Pengajuan',
            5 => 'Seminar Proposal',
            10 => 'Masa Bimbingan',
            15 => 'Pengajuan Seminar Hasil',
            20 => 'Sudah Seminar Hasil',
            25 => 'Pengajuan Sidang',
            30 => 'Selesai Sidang',
            35 => 'Batal TA/Tidak Selesai'
        ];

        protected $dates = ['start_at'];

        protected $fillable = [
            'thesis_id',
            'student_id',
            'title',
            'abstract',
            'start_at',
            'status'
            ];

        public function thesisTopic(){
            return $this->belongsTo(ThesisTopic::class,'thesis_id','id');
        }
        public function student(){
            return $this->belongsTo(Student::class,'student_id','id');
        }

        public function supervisor(){
            return $this->belongsToMany(Lecturer::class,'thesis_supervisors')->withPivot('position','status')->withTimestamps();
        }

        public static function thesisList(int $count){
            $theses = self::where('status',0)
                ->orWhere('status',30)
                ->orWhere('status',35)
                ->paginate($count);
            $theses->each(function ($thesis){
                    return $thesis->status = self::$status[$thesis->status];
            });
            return $theses;
        }
}
