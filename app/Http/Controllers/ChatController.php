<?php

namespace App\Http\Controllers;

use Storage;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use App\Negotiation;
use App\Message;

class ChatController extends Controller
{
    public function index(Request $request){
    	return view('chat');
    }

    public function saveMessage(Request $request) {
        $negotiation = Negotiation::find(1);
        // $negotiation->messages()->save(Message::create(['body' => $request->text, 'user_id' => Auth::user()->id]));
        $message = Message::create(['body' => $request->text, 'user_id' => 1, 'negotiation_id' => 0]);
        $negotiation->messages()->save($message);
        return [
            // 'user' => $message->user->id == Auth::user()->id ? 'Eu' : $message->user->name
            // 'message_id' => Hashids::encode($message->id),
            'message_id' => $message->id,
            'user' => $message->user_id == 1 ? 'Eu' : 'Outra pessoa',
            'text' => $message->body,
            'created_at' => $message->created_at->format('Y-m-d H:i:s')
        ];
    }

    public function updateChat($last_message = 0) {
        // $negotiation = Negotiation::findByToken($token);
        $negotiation = Negotiation::find(1);

        if(!is_null($negotiation->messages()->first())) {
            $messages = $negotiation->messages()
                // ->where('id', '>', Hashids::decode($last_message))
                ->where('id', '>', $last_message)
                ->orderBy('id', 'desc')
                // ->where('user_id', '<>', 1)
                ->limit(25)
                ->get();
            
            if(count($messages) > 0) {
                $data = [];
                foreach($messages as $message) {
                    $data[] = [
                        // 'user' => $message->user->id == Auth::user()->id ? 'Eu' : $message->user->name
                        // 'message_id' => Hashids::encode($message->id),
                        'message_id' => $message->id,
                        'user' => $message->user_id == 1 ? 'Eu' : 'Outra pessoa',
                        'text' => $message->body,
                        'created_at' => $message->created_at->format('Y-m-d H:i:s')
                    ];
                }

                return $data;
            }
        }

        return;
    }

    public function olderMessages($token) {
        $negotiation = Negotiation::find(1);

        if(!is_null($negotiation->messages()->first())) {
            $messages = $negotiation->messages()
                // ->where('id', '<', Hashids::decode($token))
                ->where('id', '<', $token)
                ->orderBy('id', 'desc')
                ->limit(25)
                ->get();

            if(count($messages) > 0) {
                $data = [];
                foreach($messages as $message) {
                    $data[] = [
                        // 'user' => $message->user->id == Auth::user()->id ? 'Eu' : $message->user->name
                        // 'message_id' => Hashids::encode($message->id),
                        'message_id' => $message->id,
                        'user' => $message->user_id == 1 ? 'Eu' : 'Outra pessoa',
                        'text' => $message->body,
                        'created_at' => $message->created_at->format('Y-m-d H:i:s')
                    ];
                }

                return $data;
            }
        }

        return;
    }
}