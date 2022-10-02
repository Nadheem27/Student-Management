<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Teacher;

class Students extends Model 
{

    protected $table = 'students';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('teacher_id', 'name', 'age', 'gender');

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }

    public function scopeSearch($query, $search)
    {
        if($search == 'M')
            $search = '1';

        if($search == 'F')
            $search = '0';

        return $query->where('name', 'LIKE', '%'.$search.'%')
                    ->orWhere('age', 'LIKE', '%'.$search.'%')
                    ->orWhere('gender', 'LIKE', '%'.$search.'%');
    }

}