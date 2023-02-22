<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class donasi extends Model
{
    use HasFactory;
    protected $table = 'donasi';
    protected $fillable = ['judul','tgl_mulai','tgl_selesai','total','ket'];
}
