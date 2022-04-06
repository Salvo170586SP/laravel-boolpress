<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\MessageMail;
use Illuminate\Support\Facades\Validator;

class MessageMailController extends Controller
{
    public function send(Request $request){

        $data = $request->all();

        //#VALIDAZIONE
        $validator = Validator::make($data, [
            'email' => 'required|email',
            'message' => 'required',
        ],[
            'email.required' => 'La mail è obbligatoria',
            'email.email' => 'L\'indirizzo email non è valido',
            'message.required' => 'Il messaggio è obbligatorio',
        ]);

        //controllo che non fallisce
        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()]);
        }

        //inizializzo il mailable e gli passo i dati
        $mail = new MessageMail($data);
        
        //indico chi è chi invia la mail e passo la variabile 
        Mail::to(env('MAIL_ADMIN_ADDRESS'))->send($mail);

        //ritorno la risposta di ok! (messaggio inviato correttamente)
        return response('Mail sent', 204);
    }
}
