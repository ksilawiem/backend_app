<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Test;
use App\Models\Quiz_question;

class QuizQuestionController extends Controller
{
    public function add($id){
        $data = request()->validate([
          'content'=> 'required'
        ]);
        $test = Test::where('id',$id)->first();
        $new_question_num = $test->nbr_qst + 1; 
        $test->nbr_qst = $new_question_num;
        $test->save();
         $new_question = Quiz_question::create([
          'test_id'=> $id,
          'content'=> $data['content']
          ]);
  
          return response()->json(['message' =>  'Question created', 'question' => $new_question], 201);
    }

    public function getQuestionById($id){
        $question = Quiz_question::where('id',$id)->first();
        return response()->json($question);
    }

    public function getQuestionsByTest($test_id){
        $questions = Quiz_question::where('test_id', $test_id)->get();
        return response()->json($questions);
    }

    public function updateQuestion($id){
        $data = request()->validate([
            'content'=> 'required'
          ]);
        $question = Quiz_question::where('id',$id)->first();
        $question->content=$data['content'];
        $question->save();
        return response()->json($question);
    }

    public function delete($id){
        $question = Quiz_question::where('id',$id)->first();
        $question->delete();
        return response()->json(['message'=> ' question deleted successfully'],200);
    }

}
