<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Students;
use App\Models\Term;

class Marks extends Model 
{

    protected $table = 'marks';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('student_id', 'term_id', 'maths', 'science', 'history');

    public function getTotalMarkAttribute()
    {
        return $this->maths + $this->science + $this->history;
    }

    public function student()
    {
        return $this->belongsTo(Students::class, 'student_id');
    }

    public function term()
    {
        return $this->belongsTo(Term::class, 'term_id');
    }

    public function scopeSearch($query, $search)
    {
        return $query->where('maths', 'LIKE', '%'.$search.'%')
                    ->orWhere('science', 'LIKE', '%'.$search.'%')
                    ->orWhere('history', 'LIKE', '%'.$search.'%')
                    ->orWhere('total', 'LIKE', '%'.$search.'%');
    }

}