<?php

namespace App\Http\Controllers;

use App\Mail\SendMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
     function index(){
        return view('backend.email.index');
     }
     function send_mail(Request $request){
        $request->validate([
            'to'=>'required',
            'subject'=>'required',
            'body'=>'required',
        ]);

        $mailData = [
            'subject' => $request->subject,
            'body' => $request->body,
        ];
        Mail::to($request->to)->send(new SendMail($mailData));
        return back()->with('success','Email send Successfully');
     }
}
