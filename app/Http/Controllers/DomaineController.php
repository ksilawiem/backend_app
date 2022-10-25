<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Domaine;

class DomaineController extends Controller
{
    public function create($user_id){
        $data = request()->validate([
            'name'=> 'required'
        ]);
           $domaine = Domaine::create([
            'user_id'=> $user_id,
            'name'=> $data['name']
            ]);
    
        return response()->json(['message' => 'domaine created', 'domaine' => $domaine], 201);    
    }

    public function getDomaineByUser($user_id){
        $domaines = Domaine::where('user_id',$user_id)->get();
        return response()->json(['message' => 'domaines', 'domaines' => $domaines], 201);
    }

    public function updateDomaine($id){
        $data = request()->validate([
            'name'=> 'required'
          ]);
        $domaine = Domaine::where('id',$id)->first();
        $domaine->name=$data['name'];
        $domaine->save();
        return response()->json($domaine);
    }

    public function delete($id){
        $domaine = Domaine::where('id',$id)->first();
        $domaine->delete();
        return response()->json(['message'=> ' domaine deleted successfully'],200);
    }

}
