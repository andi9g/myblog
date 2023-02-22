<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class advanced extends Model
{
    use HasFactory;
    protected $table = 'advanced';
    protected $fillable = ['jumlah_tampil','nama_website'];
}
