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
        //uzeti mail iz forme i staviti da je to mail od posaljioca and MAIL TO je od vlasnika sajta
       $validation =  $request->validated();
        return [$validation, 'message'=> 'E-mail je poslat!'];
        //     Mail::to('info@nskont.rs')
        //     ->send(new Contact(validation['email']));
        // return redirect('/mail')->with('message', 'Email sent!');

    }
}
