<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class studentsData extends Model
{
    use HasFactory;
    protected $table = "students_data";

    protected $fillable = ['name','school_name','birthday','nisn','mother_name'];

    
}
