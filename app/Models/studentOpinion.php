<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class studentOpinion extends Model
{
    use HasFactory;
    protected $table = "studen_opions";

    protected $fillable = ['users_id','opiniTopic_id','reason','isPositifOpini'];
    public function Users() {
        return $this->hasOne(User::class, 'id','users_id');
    }

}
