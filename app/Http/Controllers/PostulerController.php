<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Postuler;
use App\Models\Offre_answer;
use App\Models\Offre;
use App\Models\Offre_question;

class PostulerController extends Controller
{
    //
    public function create($user_id, $offre_id){
        $data = request()->validate([
            'startedAt'=> 'required'
        ]);
           $newPostuler = Postuler::create([
            'user_id'=> $user_id,
            'offre_id'=> $offre_id,
            'startedAt'=> $data['startedAt']
            ]);
    
        return response()->json(['message' => 'offre Postuler', 'Postuler' => $newPostuler], 201);    
    }

    public function checkAnswer($post_id,$answer_id){
        $data = request()->validate([
            'valid'=> 'required'
        ]);
        $post = Postuler::where('id',$post_id)->first();
        $offre = Offre::where('id',$post->offre_id)->first();
        $answer = Offre_answer::where('id',$answer_id)->first();
        $question = Offre_question::where('id',$answer->question_id)->first();
        $answerValidation = $answer->valid;
        $answerNumbers = $question->nbr_ans;
        $numberCheck = $post->checkedAnswer + 1;
        $post->checkedAnswer = $numberCheck;
        $validAnswers = $post->validAnswer;
        if ($data['valid'] == $answerValidation){
            $post->validAnswer = $validAnswers+1;
            $post->save();
        }
        if($numberCheck == $answerNumbers){
            if($post->validAnswer == $numberCheck){
                $scoreToAdd = $offre->score/$offre->nbr_qst;
                $score = $post->score + $scoreToAdd;
                $post->score = $score;
                $post->validAnswer = 0;
                $post->checkedAnswer = 0;
                $post->save();
            }else{
                $post->validAnswer = 0;
                $post->checkedAnswer = 0;
                $post->save();
            }
        }
        $post->save();
        return response()->json(['message' => 'posted updated', 'post' => $post], 201); 
    }

    public function getPostById($id){
        $post = Postuler::where('id',$id)->first();
        return response()->json(['message' => 'posted', 'post' => $post], 201);
    }

    public function getPostByUser($user_id){
        $post = Postuler::where('user_id',$user_id)->get();
        return response()->json(['message' => 'posted', 'posts' => $post], 201);
    }

    public function getPostbyOffre($offre_id){
        $post = Postuler::where('offre_id',$offre_id)->get();
        return response()->json(['message' => 'posted', 'posts' => $post], 201);
    }

    public function delete($id){
        $post = Postuler::where('id',$id)->first();
        $post->delete();
        return response()->json(['message'=> ' post deleted successfully'],200);
    }
}
