<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class calonanggota extends Model
{
    use HasFactory;
    protected $table = 'calonanggota';
    protected $fillable = ['nim','nama','alamat','hp','email','pesan','perangkat'];
}
