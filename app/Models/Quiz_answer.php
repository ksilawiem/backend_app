<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class quiz_answer extends Model
{
    use HasFactory;
    protected $table= 'quiz_answers';
    protected $fillable = [
     'content',
     'question_id',
     'valid',
     'test_id'
    ];
}
