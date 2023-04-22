<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comment_vote extends Model
{
    use HasFactory;

    protected $table = 'comment_vote';
    protected $primaryKey = 'vote_id';
}
