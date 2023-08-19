<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of all the users.
     */
    public function index()
    {
        $loggedInUserId = Auth::id(); // Get the ID of the currently logged-in user

        $users = User::where('id', '!=', $loggedInUserId)
            ->orderBy('last_activity', 'desc')
            ->get(); // Retrieve all users except the logged-in user, sorted by last_activity


        return response()->json($users);
    }

    /**
     * heartbeat request for updating the last_activity timestamp for the user.
     */

    public function heartbeat() {
        $user = auth()->user();
        $user->last_activity = now();
        $user->save();
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
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
