<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;

class ChatController extends Controller
{
    // open chat window
    public function show($userId)
    {
        $authId = auth()->id();

        $user = User::findOrFail($userId);

        $messages = Message::where(function ($q) use ($authId, $userId) {
                $q->where('sender_id', $authId)
                  ->where('receiver_id', $userId);
            })
            ->orWhere(function ($q) use ($authId, $userId) {
                $q->where('sender_id', $userId)
                  ->where('receiver_id', $authId);
            })
            ->orderBy('timestamp', 'asc')
            ->get();

        // mark messages as read
        Message::where('sender_id',$userId)
            ->where('receiver_id',$authId)
            ->where('status','unread')
            ->update(['status'=>'read']);

        return view('massages',compact('messages','user'));
    }

    // send message
    public function send(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required',
            'message' => 'required'
        ]);

        Message::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $request->receiver_id,
            'message' => $request->message,
            'status' => 'unread'
        ]);

        return back();
    }
}