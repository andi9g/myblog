<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class setweb extends Model
{
    use HasFactory;
    protected $table = 'web';
    protected $fillable = ['title','footer'];
}
