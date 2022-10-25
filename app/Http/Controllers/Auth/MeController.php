<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MeController extends Controller
{
    public function __construct(){
return response()->json([ 'valid' => auth()->check() ]);
    }

    public function __invoke(Request $request){
       $user = $request->user();
       return response()->json([
        'email' => $user->email,
        'name' => $user->firstName,
       ]);
    }
}
