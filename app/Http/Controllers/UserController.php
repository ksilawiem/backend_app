<?php

namespace App\Http\Controllers;
use App\Mail\NotifyMail;
use Mail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    // create new user

    public function create() {
        $data = request()->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'address' => 'required',
            'city' => 'required',
            'birthDate' => 'required',
            'gender' => 'required',
            'role' => 'required',
            'email' => 'required',
            'password' => 'required',
            'cv'=> 'nullable',
            'company'=> 'nullable',
            'modePaiment'=> 'nullable',
            'début'=> 'nullable',
            'fin'=> 'nullable',
        ]);
        $password = Hash::make($data['password']);
        $user = User::where('email', $data['email'])->first();
        if ($user) {
            return response()->json(['message' => 'email exist'], 400);
        }else {
            $newUser = User::create([
            'firstName'=> $data['firstName'],
            'lastName'=> $data['lastName'],
            'address'=> $data['address'],
            'city'=> $data['city'],
            'birthDate'=> $data['birthDate'],
            'gender'=> $data['gender'],
            'role'=> $data['role'],
            'email'=> $data['email'],
            'password'=> $password,
            'cv'=> $data['cv'],
            'company'=> $data['company'],
            'modePaiment'=> $data['modePaiment'],
            'début'=> $data['début'],
            'fin'=> $data['fin'],
            ]);
            if($data['role']!='recruteur'){
            $userData=array("name"=>$data['firstName'],"id"=>$newUser->id);
            $this->email=$data['email'];
            Mail::send('demoMail', $userData , function($message){
                $message->to($this->email)->subject('Email verifcation');
            });
            }
            return response()->json(['message' =>  $data['role'].' created', 'user' => $newUser], 201);
        }
    }

    public function Verification($id)
    {
        $user = User::where('id',$id)->first();
        $user->email_verified=1;
        $user->save();
        return response()->json(['message'=>'user verified'],201);
    }

    public function resubcribe($user_id){
        $data = request()->validate([
            'début' => 'required',
            'fin' => 'required',
        ]);
        $user = User::where('id',$user_id)->first();
        $user->début = $data['début'];
        $user->fin = $data['fin'];
        $user->save();
        return response()->json(['message'=> 'subscribed successfully', 'user' => $user],200);
    }

    public function unverify($user_id){
        $user = User::where('id',$user_id)->first();
        $user->email_verified=0;
        $user->save();
        return response()->json(['message'=>'user unverified'],201);
    }
    
    public function sendMail($user_id)
    {
        $user = User::where('id',$user_id)->first();
        $this->email=$user->email;
        $userData=array("name"=>$user->firstName,"id"=>$user->id);
        Mail::send('warning', $userData , function($message){
        $message->to($this->email)->subject('3 days left');
        });
        return response()->json(['message'=>'user is about to unverified'],201);
    }

    public function forgetPassword($email)
    {
        $user = User::where('email',$email)->first();
        $userData=array("name"=>$user->firstName,"id"=>$user->id);
        $this->email=$user->email;
        Mail::send('passWord', $userData , function($message){
        $message->to($this->email)->subject('PassWord reset');
        });
    }

    public function resetPassowrd($id)
    {
        $user = User::where('id',$id)->first();
        $data = request()->validate([
            'password' => 'required'
        ]);
        $password = Hash::make($data['password']);
        $user->password=$password;
        $user->save();
    }
    //  login 
    public function logIn(Request $request ) {
        $data = request()->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $user = User::where('email', $data['email'])->first();
        if(!$user){
            return response()->json(['message' => 'user not found']);
        }
        if( Hash::check($data['password'], $user->password )) {
            $token = auth()-> attempt ($request->only('email','password'));
            return response()->json(['message' => 'success','user' => $user , 'token' => $token], 201);
        }else{
            return response()->json(['message' => 'wrong email or password']);
        }

    }


    public function all (){
        $users = User::all();
        return response()->json($users);
    }

    public function getUserById($id){
        $user = User::where('id',$id)->first();
        return response()->json($user);
    }

    public function getUserByRole(){
        $users = User::where(['role','condidat'], ['role','recruteur']);
        return response()->json($users);
    }

    public function delete($id){
        $user = User::where('id',$id)->first();
        $user->delete();
        return response()->json(['message'=> ' user deleted successfully'],200);
    }
    
    public function updatePhoto ($id){
        $data = request()->validate([
            'photo' => 'required',
        ]);
        $user = User::where('id',$id)->first();
        $user->photo = $data['photo'];
        $user->save();
        return response()->json(['message'=> ' photo updated successfully','user'=>$user],200);
    }

    public function updateProfil($id){
        $data = request()->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'address' => 'required',
            'linkedin' =>'nullable',
            'twitter' => 'nullable',
            'email' => 'nullable',
        ]);
        $user = User::where('id',$id)->first();
        $user->firstName = $data['firstName'];
        $user->lastName = $data['lastName'];
        $user->address = $data['address'];
        $user->linkedin = $data['linkedin'];
        $user->twitter = $data['twitter'];
        $user->company = $data['email'];
        $user->save();
        return response()->json(['message'=> ' profile updated successfully', 'user' => $user],200);
    }
}
