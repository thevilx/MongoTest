<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['name' , 'slug'];
    protected $collection = 'tags';

    public function articles(){
        return $this->belongsToMany(Article::class);
    }
}
