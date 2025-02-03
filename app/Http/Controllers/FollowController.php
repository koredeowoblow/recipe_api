<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use App\Models\User;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    public function toggleFollow($userId)
    {
        $user = User::findOrFail($userId);

        if ($userId == auth()->id()) {
            return response()->json(['message' => 'You cannot follow yourself'], 400);
        }

        $follow = Follow::where('follower_id', auth()->id())
                        ->where('following_id', $userId)
                        ->first();

        if ($follow) {
            $follow->delete();
            return response()->json(['message' => 'Unfollowed user']);
        }

        Follow::create([
            'follower_id' => auth()->id(),
            'following_id' => $userId,
        ]);

        return response()->json(['message' => 'User followed']);
    }

    public function getFollowers()
    {
        return response()->json(auth()->user()->followers()->with('follower')->get());
    }

    public function getFollowing()
    {
        return response()->json(auth()->user()->follows()->with('following')->get());
    }
}

