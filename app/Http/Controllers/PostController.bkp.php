<?php

namespace App\Http\Controllers;

use App\Post;
use Validator;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function index(){
        $posts = Post::all();

        return view('posts.index', ['posts' => $posts]);
    }

    public function create(){
    	return view('posts.create');
    }

    public function store(Request $request){
    	$validator = Validator::make($request->all(), [
            'title' =>'required',
            'content' =>'required',
        ]);

        if($validator->fails()){
            return response()->json(['errors' => $validator->messages()], 400);
        } else {
        	Post::create($request->only('title', 'content'));

        	return response()->json(['status' => 'O post foi criado com sucesso']);
        }
    }

}
