<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pegadaiant extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'nama',
        'email',
        'age',
        'no_tlp',
        'nik',
        'date',
    ]; 
}
