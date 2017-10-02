<?php

namespace App\Http\Controllers\Message;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IncomingMessageController extends Controller
{
    //

    public function index(){
    	return view("Message.reportIncomingMessage");
    }
}
