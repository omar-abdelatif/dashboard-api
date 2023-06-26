<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tags extends Model
{
    use HasFactory;
    protected $table = 'tags';
    protected $fillable = ['title'];
    public function projects()
    {
        return $this->belongsTo(Project::class);
    }
}