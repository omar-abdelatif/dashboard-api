<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $table = 'projects';
    protected $fillable = [
        'title',
        'description',
        'category',
        'tags',
        'img',
        'github',
        'url',
        'category_id',
        'tag_id'
    ];
    public function tags()
    {
        return $this->hasMany(Tags::class);
    }
}
