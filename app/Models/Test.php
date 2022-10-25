<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;


    protected $table= 'tests';
    protected $fillable = [
     'name',
     'description',
     'categorie_id'
    ];

 public function categorie(){
     return $this->belongTo(Categorie::class);
 }
}
