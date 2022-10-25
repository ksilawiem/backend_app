<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorie;
class CategorieController extends Controller
{
   
    public function create(Request $request){

        $categorie = new Categorie();

        $categorie->nom = $request->input('nom');
        $categorie->save();
        return response()->json($categorie);
    }


    public function show(){

        $categorie = Categorie::all();
        return response()->json($categorie);
    }

    public function showbyid($id){
 
        $categorie = Categorie::find($id);

        if($categorie)
        {
            return response()->json($categorie);
        }

        else {
            return response()->json(['message'=> 'No Category found'],404);
        }
        

    }


    public function update(Request $request ,$id){
       
        $categorie =  Categorie::find($id);

      if($categorie){
   
        $categorie->nom = $request->input('nom');
        
        $categorie->update();
        return response()->json(['message'=> ' Category updated successfully'],200);
     }
     else 
     {
         return response()->json(['message'=> 'No Category found'],404);

     }
    }

    public function destroy($id){

        $categorie =  Categorie::find($id);

        if($categorie){
            $categorie->delete();
            return response()->json(['message'=> ' Category deleted successfully'],200);

        }
        else {
            return response()->json(['message'=> 'No Category found'],404);
        }
    }
}

