<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Offre;
use App\Models\Offre_question;

class OffreQuestionController extends Controller
{
    //
    public function add($id){
        $data = request()->validate([
          'content'=> 'required'
        ]);
        $offre = Offre::where('id',$id)->first();
        $new_question_num = $offre->nbr_qst + 1; 
        $offre->nbr_qst = $new_question_num;
        $offre->save();
         $new_question = Offre_question::create([
          'offre_id'=> $id,
          'content'=> $data['content']
          ]);
  
          return response()->json(['message' =>  'Question created', 'question' => $new_question], 201);
    }

    public function getQuestionById($id){
        $question =  Offre_question::where('id',$id)->first();
        return response()->json($question);
    }

    public function getQuestionsByOffre($offre_id){
        $questions =  Offre_question::where('offre_id', $offre_id)->get();
        return response()->json($questions);
    }

    public function updateOffreQuestion($id){
        $data = request()->validate([
            'content'=> 'required'
          ]);
        $question =  Offre_question::where('id',$id)->first();
        $question->content=$data['content'];
        $question->save();
        return response()->json($question);
    }

    public function delete($id){
        $question = Offre_question::where('id',$id)->first();
        $question->delete();
        return response()->json(['message'=> ' question deleted successfully'],200);
    }
}
