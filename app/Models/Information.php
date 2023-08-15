<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Information extends Model
{
    use HasFactory;
    protected $table = 'inforamtions';
    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'address',
        'age'
    ];
}
