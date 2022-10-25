<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offre_answer extends Model
{
    use HasFactory;
    protected $table= 'offre_answers';
    protected $fillable = [
     'content',
     'question_id',
     'valid',
     'offre_id'
    ];
}
