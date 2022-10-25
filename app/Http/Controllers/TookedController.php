<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tooked;
use App\Models\Quiz_answer;
use App\Models\Test;
use App\Models\Quiz_question;

class TookedController extends Controller
{
    public function create($user_id, $test_id){
        $data = request()->validate([
            'startedAt'=> 'required'
        ]);
           $newTook = Tooked::create([
            'user_id'=> $user_id,
            'test_id'=> $test_id,
            'startedAt'=> $data['startedAt']
            ]);
    
        return response()->json(['message' => 'Test tooked', 'tooked' => $newTook], 201);    
    }
    
    public function checkAnswer($took_id,$answer_id){
        $data = request()->validate([
            'valid'=> 'required'
        ]);
        $took = Tooked::where('id',$took_id)->first();
        $test = Test::where('id',$took->test_id)->first();
        $answer = Quiz_answer::where('id',$answer_id)->first();
        $question = Quiz_question::where('id',$answer->question_id)->first();
        $answerValidation = $answer->valid;
        $answerNumbers = $question->nbr_ans;
        $numberCheck = $took->checkedAnswer + 1;
        $took->checkedAnswer = $numberCheck;
        $validAnswers = $took->validAnswer;
        if ($data['valid'] == $answerValidation){
            $took->validAnswer = $validAnswers+1;
            $took->save();
        }
        if($numberCheck == $answerNumbers){
            if($took->validAnswer == $numberCheck){
                $scoreToAdd = $test->score/$test->nbr_qst;
                $score = $took->score + $scoreToAdd;
                $took->score = $score;
                $took->validAnswer = 0;
                $took->checkedAnswer = 0;
                $took->save();
            }else{
                $took->validAnswer = 0;
                $took->checkedAnswer = 0;
                $took->save();
            }
        }
        $took->save();
        return response()->json(['message' => 'Tooked updated', 'took' => $took], 201); 
    }

    public function getTookById($id){
        $took = Tooked::where('id',$id)->first();
        return response()->json(['message' => 'tooked', 'took' => $took], 201);
    }

    public function getTookByUser($user_id){
        $took = Tooked::where('user_id',$user_id)->get();
        return response()->json(['message' => 'tooked', 'tooks' => $took], 201);
    }

    public function delete($id){
        $took = Tooked::where('id',$id)->first();
        $took->delete();
        return response()->json(['message'=> ' took deleted successfully'],200);
    }
}
