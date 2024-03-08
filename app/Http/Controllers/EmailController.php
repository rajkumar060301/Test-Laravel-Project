<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function emailSend(){

        $data = ['name'=> 'test email', 'data'=>'Hello Testing'];
        $user['to'] = "rajkumarktr10@gmail.com";
        Mail::send('mail',$data,function($message) use ($user){
            $message->to( $user['to']);
            $message->subject('Order confirmations');

        });
    }


}
