<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offre_question extends Model
{
    use HasFactory;
    protected $table= 'offre_questions';
    protected $fillable = [
     'content',
     'offre_id'
    ];
}
