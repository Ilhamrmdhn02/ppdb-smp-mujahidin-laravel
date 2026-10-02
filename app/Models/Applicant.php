<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    protected $fillable = ['registration_code','name','nickname','gender','nisn','nik','birth_place','birth_date','religion','phone','email','address','previous_school','parent_name','parent_phone','status','payment_status'];
    protected $casts = ['birth_date' => 'date'];
}
