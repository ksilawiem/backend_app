<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Experience;


class ExperienceController extends Controller
{
    public function create($user_id){
        $data = request()->validate([
            'startedAt'=> 'required',
            'endedAt'=> 'required',
            'enterprise'=> 'required',
        ]);
           $experience = Experience::create([
            'user_id'=> $user_id,
            'startedAt'=> $data['startedAt'],
            'endedAt'=> $data['endedAt'],
            'enterprise'=> $data['enterprise'],
            ]);
    
        return response()->json(['message' => 'experience created', 'experience' => $experience], 201);    
    }

    public function getExperienceByUser($user_id){
        $experiences = Experience::where('user_id',$user_id)->get();
        return response()->json(['message' => 'experiences', 'experiences' => $experiences], 201);
    }

    public function updateExperience($id){
        $data = request()->validate([
            'startedAt'=> 'required',
            'endedAt'=> 'required',
            'enterprise'=> 'required',
          ]);
        $experience = Experience::where('id',$id)->first();
        $experience->startedAt=$data['startedAt'];
        $experience->endedAt=$data['endedAt'];
        $experience->enterprise=$data['enterprise'];
        $experience->save();
        return response()->json($experience);
    }

    public function delete($id){
        $experience = Experience::where('id',$id)->first();
        $experience->delete();
        return response()->json(['message'=> ' experience deleted successfully'],200);
    }

}
