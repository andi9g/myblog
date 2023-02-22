<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class slideGambar extends Model
{
    use HasFactory;
    protected $table = 'gambarslide';
    protected $fillable = ['gambar','judul','pesan'];
}
