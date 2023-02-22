<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rapat extends Model
{
    use HasFactory;
    protected $table = 'jadwalrapat';
    protected $fillable = ['rapat','ket','jam','tgl'];
}
