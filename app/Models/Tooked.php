<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tooked extends Model
{
    use HasFactory;
    protected $table= 'tookeds';
    protected $fillable = [
     'user_id',
     'test_id',
     'startedAt',
    ];
}
