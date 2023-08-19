<?php

use App\Models\Chat;
use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('user-status.{userId}', function ($user, $userId) {
    return true;
});

Broadcast::channel('chat.{chatId}', function ($user, $chatId) {
    $chat = Chat::find($chatId);
    return $chat && ($user->id === $chat->user1_id || $user->id === $chat->user2_id);
});

Broadcast::channel('chat-list.{userId}', function ($user, $userId) {
    //return (int) $user->id === (int) $userId;

    //to return true one of the following conditions should be met: the userId is equivalent to the user->id || or the user->id and the userId have one chat in common
    return true;
});
