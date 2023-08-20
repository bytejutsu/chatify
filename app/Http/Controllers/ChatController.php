<?php

namespace App\Http\Controllers;

use App\Events\ChatCreated;
use App\Events\ChatUpdated;
use App\Events\MessageSent;
use App\Models\Chat;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = Auth::id();

        $chats = Chat::where('user1_id', $userId)
            ->orWhere('user2_id', $userId)
            ->whereHas('latestMessage')
            ->with(['latestMessage', 'user1', 'user2'])
            ->get();



        // Transform the chats collection
        $chats = $chats->map(function ($chat) use ($userId) {
            // Determine the correspondent and unread count for the logged-in user
            $chatData = $chat->toArray(); // Convert the chat model to an array
            // Return the modified chat object
            return $chatData;
        });

        $chats = $chats->sortByDesc(function ($chatData) {
            return $chatData['latest_message']['created_at'];
        })->values()->all();

        return Inertia::render('Chat/Index', ['chats' => $chats, 'userId' => $userId]);
    }

    /**
     * Marking a Chat as Read.
     */
    public function markAsRead(Request $request, $id)
    {
        $userId = Auth::id();

        $chat = Chat::find($id);

        if ($chat->user1_id == $userId) {
            $chat->user1_unread_count = 0;
        } else {
            $chat->user2_unread_count = 0;
        }

        $chat->save();

        // Determine the correspondent and unread count for the logged-in user
        $chatData = $chat->toArray(); // Convert the chat model to an array
        $chatData['latest_message'] = $chat->latestMessage;

        // Optionally, broadcast an event if you want real-time updates elsewhere
        //event(new ChatUpdated($chatData));

        return response()->json(['message' => 'Messages marked as read']);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Start a chat with another user.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function startChat(Request $request)
    {
        // Validate the request (e.g., ensure userB_id is present and valid)
        $request->validate([
            'userB_id' => 'required|exists:users,id',
        ]);

        // IDs of the two users involved in the chat
        $userA_id = auth()->id(); // Assuming User A is the currently authenticated user
        $userB_id = $request->input('userB_id');

        // Check for existing chat between the two users
        $chat = Chat::where(function ($query) use ($userA_id, $userB_id) {
            $query->where('user1_id', $userA_id)
                ->where('user2_id', $userB_id);
        })->orWhere(function ($query) use ($userA_id, $userB_id) {
            $query->where('user1_id', $userB_id)
                ->where('user2_id', $userA_id);
        })->first();

        // Create a new chat if none exists
        if (!$chat) {
            $chat = Chat::create([
                'user1_id' => $userA_id,
                'user2_id' => $userB_id,
            ]);

        }

        // Redirect to the chat interface (or return a view, as needed)
        return redirect()->route('chat.show', ['id' => $chat->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
        $userId = Auth::id();

        $chat = Chat::where('id', $id)->with(['user1', 'user2', 'latestMessage', 'messages'])->first();

        // Return 404 if the chat doesn't exist
        if (!$chat) {
            abort(404);
        }

        // Check if the current user is one of the chat participants
        if ($userId !== $chat->user1->id && $userId !== $chat->user2->id) {
            // Return 403 if the current user is not a participant in the chat
            abort(403, 'You are not authorized to access this chat.');
        }

        // Determine the correspondent and unread count for the logged-in user
        if ($chat->user1_id == $userId) {
            $chat->correspondent = $chat->user2;
            $chat->unread_count = $chat->user1_unread_count;
        } else {
            $chat->correspondent = $chat->user1;
            $chat->unread_count = $chat->user2_unread_count;
        }

        return Inertia::render('Chat/ChatPage/Index', ['chat' => $chat]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $userId = Auth::id();

        // Validate the request
        $request->validate([
            'message' => 'required',
        ]);

        // Save the message to the database

        $message = Message::create([
            'content' => $request->message['content'],
            'chat_id' => $request->message['chat_id'],
            'sender_id' => $request->user()->id,
        ]);

        // Update the latest_message_id field and unread_count of the chat
        //$chat = Chat::find($request->message['chat_id']);
        $chat = Chat::with(['latestMessage','user1', 'user2'])->find($request->message['chat_id']);
        $chat->latest_message_id = $message->id;

        // Determine which user is the recipient and increment the appropriate unread_count
        if ($chat->user1_id == $request->user()->id) {
            $chat->user2_unread_count += 1;
        } else {
            $chat->user1_unread_count += 1;
        }

        $chat->save();

        // Refresh the latestMessage relationship to get the updated message
        $chat->load('latestMessage');

        // Convert $chat to Array
        $chatData = $chat->toArray();

        // Fire the event
        event(new MessageSent($message));

        // Fire the ChatUpdated event with the modified chat data
        event(new ChatUpdated($chatData));

        // Return a response
        return response()->json(['message' => 'Success'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
