<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\Chat;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Chat/Index');
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
        $chat = Chat::find($id);

        $chat->load('user1'); // Load the user1 relationship
        $chat->load('user2'); // Load the user2 relationship
        $chat->load('latestMessage');
        $chat->load('messages');

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
        //dd('update is {$id}');

        // Validate the request
        $request->validate([
            'message' => 'required',
        ]);

        // Save the message to the database
        /*
        $message = Message::create([
            'content' => $request->message,
            'chat_id' => $request->chat_id,
            // other fields like user_id, etc.
        ]);
        */

        $message = $request['message'];

        // Fire the event
        event(new MessageSent($message));

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
