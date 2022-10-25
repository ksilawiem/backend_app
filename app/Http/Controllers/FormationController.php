<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Formation;

class FormationController extends Controller
{
    public function create($user_id){
        $data = request()->validate([
            'name'=> 'required',
            'institut'=> 'required',
            'formationDate'=> 'required',
        ]);
           $formation = Formation::create([
            'user_id'=> $user_id,
            'name'=> $data['name'],
            'institut'=> $data['institut'],
            'formationDate'=> $data['formationDate'],
            ]);
    
        return response()->json(['message' => 'formation created', 'formation' => $formation], 201);    
    }

    public function getFormationByUser($user_id){
        $formations = Formation::where('user_id',$user_id)->get();
        return response()->json(['message' => 'formations', 'formations' => $formations], 201);
    }

    public function updateFormation($id){
        $data = request()->validate([
            'name'=> 'required',
            'institut'=> 'required',
            'formationDate'=> 'required',
          ]);
        $formation = Formation::where('id',$id)->first();
        $formation->name=$data['name'];
        $formation->institut=$data['institut'];
        $formation->formationDate=$data['formationDate'];
        $formation->save();
        return response()->json($formation);
    }

    public function delete($id){
        $formation = Formation::where('id',$id)->first();
        $formation->delete();
        return response()->json(['message'=> ' formation deleted successfully'],200);
    }

}
