<?php

namespace App\Models;
use App\Models\Like;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $table = 'post';
    protected $primaryKey = 'post_id';

    public function like(){
        return $this->hasMany(Like::class, 'post_id', 'post_id');
    }
}
