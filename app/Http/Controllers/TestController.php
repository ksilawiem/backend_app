<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Test;
use App\Models\Categorie;
class TestController extends Controller
{
    //create the test


    public function addTest($id){
      $data = request()->validate([
        'name'=> 'required',
        'description'=> 'required',
    ]);
       $newTest = Test::create([
        'categorie_id'=> $id,
        'name'=> $data['name'],
        'description'=> $data['description'],
        ]);

        return response()->json(['message' =>  $data['name'].' created', 'test' => $newTest], 201);
    }


    public function getTestById($id){
      $test = Test::where('id',$id)->first();
      return response()->json($test);
    }

    public function getTestByCat($cat_id){
      $tests = Test::where('categorie_id', $cat_id)->get();
      return response()->json($tests);
    }

    public function updateTest($id){
      $data = request()->validate([
        'name'=> 'required',
        'description'=> 'required',
       ]);
      $test = Test::where('id',$id)->first();
      $test->name=$data['name'];
      $test->description=$data['description'];
      $test->save();
      return response()->json($test);
    }

    public function delete($id){
      $test = Test::where('id',$id)->first();
      $test->delete();
      return response()->json(['message'=> ' test deleted successfully'],200);
  }
}
