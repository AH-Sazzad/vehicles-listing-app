<?php

namespace App\Http\Controllers;

use App\Models\Massage;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\VehiclesDetail;
 
class MassageController extends Controller
{
    public function index()
    {
        $authId = auth()->id();

        $messages = Massage::where('sender_id',$authId)
            ->orWhere('receiver_id',$authId)
            ->orderBy('timestamp','desc')
            ->get();
        
        $conversations = [];

        foreach ($messages as $message) {
            $userId = $message->sender_id == $authId
                ? $message->receiver_id
                : $message->sender_id;

            if (!isset($conversations[$userId])) {
                $user = User::find($userId);
                if (!$user) continue;

                $latestMessage = Massage::where(function ($q) use ($authId,$userId) {
                        $q->where('sender_id',$authId)
                          ->where('receiver_id',$userId);
                    })
                    ->orWhere(function ($q) use ($authId,$userId) {
                        $q->where('sender_id',$userId)
                          ->where('receiver_id',$authId);
                    })
                    ->orderBy('timestamp','desc')
                    ->first();

                $unread = Massage::where('sender_id',$userId)
                    ->where('receiver_id',$authId)
                    ->where('status','unread')
                    ->count();

                $conversations[$userId] = [
                    'user' => $user,
                    'latest_message' => $latestMessage,
                    'unread_count' => $unread
                ];
            }
        }

        $conversations = array_values($conversations);
        $unreadCount = Massage::where('receiver_id',$authId)->where('status','unread')->count();

        return view('massages',compact('conversations','unreadCount'));
    }

    public function show($userId)
    {
        $authId = auth()->id();
        $user = User::findOrFail($userId);
        $vehicleId = request('vehicle');

        $messages = Massage::with('vehicle.images')->where(function ($q) use ($authId, $userId) {
                $q->where('sender_id', $authId)->where('receiver_id', $userId);
            })
            ->orWhere(function ($q) use ($authId, $userId) {
                $q->where('sender_id', $userId)->where('receiver_id', $authId);
            })
            ->orderBy('timestamp', 'asc')
            ->get();

        Massage::where('sender_id',$userId)
            ->where('receiver_id',$authId)
            ->where('status','unread')
            ->update(['status'=>'read']);

        $vehicle = $vehicleId ? VehiclesDetail::with('images')->find($vehicleId) : $messages->whereNotNull('vehicle_id')->first()?->vehicle;

        $conversations = $this->getConversations();
        $unreadCount = Massage::where('receiver_id',$authId)->where('status','unread')->count();

        return view('massages',compact('messages','user','conversations','unreadCount','vehicle'));
    }

    public function send(Request $request)
    {
        $validated = $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'message' => 'required|string|max:5000',
            'vehicle_id' => 'nullable|exists:vehicles_details,id'
        ]);

        $msg = Massage::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $validated['receiver_id'],
            'vehicle_id' => $validated['vehicle_id'] ?? null,
            'message' => $validated['message'],
            'status' => 'unread',
            'timestamp' => now()
        ]);

        return response()->json([
            'success' => true,
            'message' => $msg->message,
            'timestamp' => $msg->timestamp->format('g:i A'),
            'sender_name' => auth()->user()->name
        ]);
    }

    private function getConversations()
    {
        $authId = auth()->id();
        $messages = Massage::where('sender_id',$authId)
            ->orWhere('receiver_id',$authId)
            ->orderBy('timestamp','desc')
            ->get();
        
        $conversations = [];
        foreach ($messages as $message) {
            $userId = $message->sender_id == $authId ? $message->receiver_id : $message->sender_id;
            if (!isset($conversations[$userId])) {
                $user = User::find($userId);
                $latestMessage = Massage::where(function ($q) use ($authId,$userId) {
                        $q->where('sender_id',$authId)->where('receiver_id',$userId);
                    })
                    ->orWhere(function ($q) use ($authId,$userId) {
                        $q->where('sender_id',$userId)->where('receiver_id',$authId);
                    })
                    ->orderBy('timestamp','desc')
                    ->first();

                $unread = Massage::where('sender_id',$userId)
                    ->where('receiver_id',$authId)
                    ->where('status','unread')
                    ->count();

                $conversations[$userId] = [
                    'user' => $user,
                    'latest_message' => $latestMessage,
                    'unread_count' => $unread
                ];
            }
        }
        return array_values($conversations);
    }
}