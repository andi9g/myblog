<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sosialmedia extends Model
{
    use HasFactory;
    protected $table = 'sosialmedia';
    protected $fillable = ['facebook','instagram','twitter','pinterest'];
}
