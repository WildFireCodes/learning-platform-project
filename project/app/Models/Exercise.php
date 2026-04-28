<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    use HasFactory;


    public function user()
    {
       return $this->belongsToMany(User::class,'exercises_users','exercises_id','users_id',)->withPivot('is_correct','user_answer');
    }

}
