<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Mail\NotifyMail;

use Mail;

class SendEmailController extends Controller
{
    public function sendEmail()
    {
 
      Mail::to('hellpro48@gmail.com')->send(new NotifyMail());
 
      if (Mail::failures()) {
           return response()->json('Sorry! Please try again latter');
      }else{
           return response()->json('Great! Successfully send in your mail');
         }
    } 
}
