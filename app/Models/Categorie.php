<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
   protected $table= 'categories';
   protected $fillable = [
    'nom',
    'nbrtest',
    
];

public function tests(){
    
    return $this->hasMany(Test::class);
     
}
}
