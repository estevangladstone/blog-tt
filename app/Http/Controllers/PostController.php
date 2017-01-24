<?php

namespace App\Http\Controllers;

use Validator;
use App\Postagem;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function create(){
    	return view('create-post');
    }

    public function store(Request $request){
    	$validator = Validator::make($request->all(), [
    		'titulo' => 'required',
    		'conteudo' => 'required'
    	]);

    	Postagem::create($request->only('titulo', 'conteudo'));

    	if($validator->passes()){
    		return back()->with('status', 'Postagem criada com sucesso!');
    	} else {
    		return back()->withErrors($validator->messages());	
    	}
    }
}
