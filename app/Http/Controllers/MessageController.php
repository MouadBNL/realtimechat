<?php

namespace App\Http\Controllers;

use App\Message;
use App\Events\MessageSent;
use App\Events\ChatEvent;
use Illuminate\Http\Request;

class MessageController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the message.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('chat.chat');
    }

    /**
     * get all the messages.
     *
     * @return \Illuminate\Http\Response
     */
    public function fetchAllMessages()
    {
        $messages = [];
        foreach (Message::with('user')->get() as $m) {
            array_push($messages, [
                'user' => $m->user->name,
                'content' => $m->content,
            ]);
        }
    	return json_encode($messages);
    }

    /**
     * Store a newly created message in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'content' => ['required', 'string'],
        ]);

        $msg = auth()->user()->messages()->create([
            'content' => $data['content']
        ]);

        broadcast(new MessageSent($data['content'], auth()->user()->name))->toOthers();

        return [
            'content' => $msg->content,
            'user' => auth()->user()->name,
        ];
    }
}
