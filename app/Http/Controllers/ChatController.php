<?php

namespace App\Http\Controllers;

use Storage;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index(Request $request){
    	return view('chat');
    }

    public function getMessages(Request $request){
    	try {
    	    $contents = Storage::get("messages.html");
    	}
    	catch (Illuminate\Filesystem\FileNotFoundException $exception) {
    	    die("O arquivo não existe");
    	}

    	return $contents;
    }

    public function sendMessage(Request $request){
    	if($request->message == ''){ return; }

    	if(strpos($request->message, "###21a4da ") == '0'){
    		$message = substr($request->message, 3, strlen($request->message)-1);
    	} else {
    		$message = htmlspecialchars($request->message, ENT_QUOTES);
    	}

		$f = fopen(storage_path("app/messages.html"), "a");
		$time = date("H:i:s");
		fwrite($f, "<p class='alert alert-info alert-auto'>$time: ".$message."</p><br>" );
		fclose($f);
    }
}