<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class opinionTopic extends Model
{
    use HasFactory;
    protected $table = "opini_topics";
    protected $fillable = ['title','thumbnail','content', 'totalOpinion', 'totalPositifOpinion', 'totalNegatifOpinion', 'topicMaker'];

    public function studentsOpinion()
    {
        return $this->hasMany(studentOpinion::class, 'opiniTopic_id', 'id');
    }
   

    
}
