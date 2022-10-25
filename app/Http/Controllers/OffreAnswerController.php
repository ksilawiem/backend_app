<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Offre_answer;
use App\Models\Offre_question;

class OffreAnswerController extends Controller
{
    //
    public function add($offre_id,$question_id){
        $data = request()->validate([
          'content'=> 'required',
          'valid'=>'required'
        ]);
        $question = Offre_question::where('id',$question_id)->first();
        $new_ans_num = $question->nbr_ans + 1; 
        $question->nbr_ans = $new_ans_num;
        $question->save();
         $new_answer = Offre_answer::create([
          'offre_id'=> $offre_id,
          'question_id'=> $question_id,
          'content'=> $data['content'],
          'valid'=>$data['valid']
          ]);
          return response()->json(['message' =>  'Answer created', 'answer' => $new_answer], 201);
    }

    public function getAnswerById($id){
        $answer = Offre_answer::where('id',$id)->first();
        return response()->json($answer);
    }

    public function getAnswersByQuestion($offre_id,$question_id){
        $answers = Offre_answer::where([['offre_id', $offre_id],['question_id',$question_id]])->get();
        return response()->json($answers);
    }

    public function updateOffreAnswer($id){
        $data = request()->validate([
            'content'=> 'required',
            'valid'=>'required'
          ]);
        $answer = Offre_answer::where('id',$id)->first();
        $answer->content=$data['content'];
        $answer->valid=$data['valid'];
        $answer->save();
        return response()->json($answer);
    }


    public function delete($id){
        $answer = Offre_answer::where('id',$id)->first();
        $answer->delete();
        return response()->json(['message'=> ' answer deleted successfully'],200);
    }
}
