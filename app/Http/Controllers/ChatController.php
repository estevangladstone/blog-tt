<?php

namespace App\Http\Controllers;

use Storage;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index(Request $request){
    	return view('chat');
    }

    // TODO: Fazer checagem e criar o arquivo de mensagens caso não exista
    // TODO: Criar canais para diferentes chats poderem existir
    public function getMessages(Request $request){
    	try {
    	    $contents = Storage::get("messages.html");
    	}
    	catch (Illuminate\Filesystem\FileNotFoundException $exception) {
    	    die("O arquivo não existe");
    	}

    	return $contents;
    }


    // TODO: Melhorar a forma como as mensagens são armazenadas. Ex.: Banco de Dados
    // TODO: Criar forma de identificar o usuário para diferenciar as mensagens dele
    public function sendMessage(Request $request){
    	if($request->message == ''){ return; }

		$message = htmlspecialchars($request->message, ENT_QUOTES);

		$f = fopen(storage_path("app/messages.html"), "a");
		$time = date("H:i:s");
		fwrite($f, "<p class='alert alert-info alert-auto'>$time: ".$message."</p><br>" );
		fclose($f);
    }
}