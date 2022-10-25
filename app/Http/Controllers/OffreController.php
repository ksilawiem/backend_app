<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Offre;


class OffreController extends Controller
{
    //

    public function addOffre($user_id){
        $data = request()->validate([
            'name'=> 'required',
            'description'=> 'required',
            'address'=> 'required',
            'telefone'=> 'required',
            'categorie'=> 'required',
            'temps'=> 'required',
            'logo'=> 'required',
      ]);
         $newOffre = Offre::create([
          'name'=> $data['name'],
          'description'=> $data['description'],
          'address'=> $data['address'],
          'telefone'=> $data['telefone'],
          'temps'=> $data['temps'],
          'logo'=> $data['logo'],
          'categorie'=> $data['categorie'],
          'user_id'=> $user_id
          ]);
  
          return response()->json(['message' =>  $data['name'].' created', 'Offre' => $newOffre], 201);
      }


      public function getOffreById($id){
        $offre = Offre::where('id',$id)->first();
        return response()->json($offre);
      }

      public function all  (){
        $offres = Offre::all();
        $token = auth()->refresh();
        return response()->json(['offres'=> $offres,'token'=>$token]);
    }

      public function updateOffre($id){
        $data = request()->validate([
          'name'=> 'required',
          'description'=> 'required',
          'address'=> 'required',
          'telefone'=> 'required',
          'categorie'=> 'required',
          'temps'=> 'required',
          'logo'=> 'required',
        ]);
        $offre = Offre::where('id',$id)->first();
        $offre->name=$data['name'];
        $offre->description=$data['description'];
        $offre->address=$data['address'];
        $offre->telefone=$data['telefone'];
        $offre->categorie=$data['categorie'];
        $offre->categorie=$data['temps'];
        $offre->categorie=$data['logo'];
        $offre->save();
        return response()->json($offre);
      }
      
      public function getOffreByUser($user_id)
      {
        $offre = Offre::where('user_id',$user_id)->get();
        return response()->json($offre);
      }

      public function delete($id){
        $offre = Offre::where('id',$id)->first();
        $offre->delete();
        return response()->json(['message'=> ' offre deleted successfully'],200);
    }
}
