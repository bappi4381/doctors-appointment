<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctors extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',  // Add 'user_id' to the fillable array
        'specialization_id',
        'bio',
        'experience',
    ];
}
