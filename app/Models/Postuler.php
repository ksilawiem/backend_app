<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Postuler extends Model
{
    use HasFactory;

    protected $table= 'postulers';
    protected $fillable = [
     'user_id',
     'offre_id',
     'startedAt',
    ];
}
