<?php

namespace App\Http\Controllers;

use App\Message;
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
    	return Chat::with('user')->get();
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
        
        broadcast(new MessageSent($msg->content, auth()->user()->name));

        return ['status' => 'success'];
    }
}
