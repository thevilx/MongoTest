<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    protected $primaryKey = '_id';
    protected $fillable = ['title' , 'description' , 'slug'];
    protected $collection = 'articles';

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

}
