<?php

namespace App\Http\Controllers;
use App\Http\Requests\ContactMailRequest;
use App\Mail\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    //
    public function show(){
        return view('contact');
    }
    public function store(ContactMailRequest $request){
       $validation =  $request->validated();
       Mail::to('info@nskont.com')
       ->send(new Contact());
       return [$validation, 'message'=> 'E-mail je poslat!'];
    }
}
