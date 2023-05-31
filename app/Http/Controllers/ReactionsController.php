<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use App\Models\Post;
use App\Models\Reactions;
use App\Models\Reports;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReactionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function reaction_on_post($id, $likeordi)
    {
        $user = Auth::user();
        $user = User::find($user->id);
        $post = Post::find($id);
        $d = Reactions::create([

            'location_id' => $user->id,
            'location_type' => 'post',
            'user_id' => $user->id,
            'type' => $likeordi
        ]);
        if ($likeordi == 1) {
            $r = $post->value('likes_counts');
            $b = $post->update(['likes_counts' => $r + 1]);
        } else {
            $rr = $post->value('dislikes_counts');
            $b = $post->update(['dislikes_counts' => $rr + 1]);
        }
        return $d;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function reaction_on_comment($id, $likeordi)
    {
        $user = Auth::user();
        $user = User::find($user->id);
        $comment = Comments::find($id);
        $d = Reactions::create([

            'location_id' => $user->id,
            'location_type' => 'comment',
            'user_id' => $user->id,
            'type' => $likeordi

        ]);
        if ($likeordi == 1) {
            $r = $comment->value('likes_counts');
            $b = $comment->update(['likes_counts' => $r + 1]);
        } else {
            $rr = $comment->value('dislikes_counts');
            $b = $comment->update(['dislikes_counts' => $rr + 1]);
        }
        return $d;
    }
    /**
     * Store a newly created resource in storage.
     */
    public function delete_reaction_on_post($id, $likeordi)
    {

        $user = Auth::user();
        $user = User::find($user->id);
        Reactions::where('location_type', 'post')->where('location_id', $user->id)->delete();
        $aaa = $post = Post::find($id);

        if ($likeordi == 1) {
            $r = $post->value('likes_counts');
            $b = $post->update(['likes_counts' => $r - 1]);
        } else {
            $rr = $post->value('dislikes_counts');
            $b = $post->update(['dislikes_counts' => $rr - 1]);
        }
        return 'suc';
    }

    /**
     * Display the specified resource.
     */
    public function delete_reaction_on_comment($id, $likeordi)
    {
        $user = Auth::user();
        $user = User::find($user->id);
        Reactions::where('location_type', 'comment')->where('location_id', $user->id)->delete();
        $aaa = $comment = Comments::find($id);

        if ($likeordi == 1) {
            $r = $comment->value('likes_counts');
            $b = $comment->update(['likes_counts' => $r - 1]);
        } else {
            $rr = $comment->value('dislikes_counts');
            $b = $comment->update(['dislikes_counts' => $rr - 1]);
        }
        return 'suc';
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reactions $reactions)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reactions $reactions)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reactions $reactions)
    {
        //
    }
}
