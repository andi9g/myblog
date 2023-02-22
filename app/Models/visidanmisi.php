<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class visidanmisi extends Model
{
    use HasFactory;
    protected $table = 'visidanmisi';
    protected $fillable = ['gambar','visi','misi'];
}
