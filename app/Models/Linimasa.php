<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Linimasa extends Model
{
    use HasFactory;
    protected $table = "linimasa";
    protected $fillable = ['judul','tgl_mulai','tgl_akhir'];
}
