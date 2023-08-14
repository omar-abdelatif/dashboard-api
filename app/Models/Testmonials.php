<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testmonials extends Model
{
    use HasFactory;
    protected $table = 'testmonials';
    protected $fillable = [
        'client_name',
        'title',
        'img',
    ];
}
