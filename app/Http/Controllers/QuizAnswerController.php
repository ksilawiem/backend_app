<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz_answer;
use App\Models\Quiz_question;

class QuizAnswerController extends Controller
{
    public function add($test_id,$question_id){
        $data = request()->validate([
          'content'=> 'required',
          'valid'=>'required'
        ]);
        $question = Quiz_question::where('id',$question_id)->first();
        $new_ans_num = $question->nbr_ans + 1; 
        $question->nbr_ans = $new_ans_num;
        $question->save();
         $new_answer = Quiz_answer::create([
          'test_id'=> $test_id,
          'question_id'=> $question_id,
          'content'=> $data['content'],
          'valid'=>$data['valid']
          ]);
          return response()->json(['message' =>  'Answer created', 'answer' => $new_answer], 201);
    }

    public function getAnswerById($id){
        $answer = Quiz_answer::where('id',$id)->first();
        return response()->json($answer);
    }

    public function getAnswersByQuestion($test_id,$question_id){
        $answers = Quiz_answer::where([['test_id', $test_id],['question_id',$question_id]])->get();
        return response()->json($answers);
    }

    public function updateAnswer($id){
        $data = request()->validate([
            'content'=> 'required',
            'valid'=>'required'
          ]);
        $answer = Quiz_answer::where('id',$id)->first();
        $answer->content=$data['content'];
        $answer->valid=$data['valid'];
        $answer->save();
        return response()->json($answer);
    }

    public function delete($id){
        $answer = Quiz_answer::where('id',$id)->first();
        $answer->delete();
        return response()->json(['message'=> ' answer deleted successfully'],200);
    }
}
