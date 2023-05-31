<?php

namespace App\Http\Controllers;

use App\Models\Communities;
use App\Models\Post;
use App\Models\Page;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function create_post_from_profile(Request $request)
    {
        $user = Auth::user();
        $user = User::find($user->id);

        return $user->posts()->create([
            'title' => $request->title,
            'Content' => $request->Content,
            'type' => $request->type,
            'user_id' => $user->id
        ]);
    }

    public function add_photos_to_post_from_profile(Request $request, $id)
    {
        $user = Auth::user();
        $user = User::find($user->id);

        $b = $user->posts()->find($id)->Photos()->create([
            'photo_name' => $request->photo_name
        ]);
        return $b;
    }
    public function add_videos_to_post_from_profile(Request $request, $id)
    {
        $user = Auth::user();
        $user = User::find($user->id);

        $b = $user->posts()->find($id)->videos()->create([
            'video_name' => $request->video_name
        ]);
        return $b;
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create_post_from_page(Request $request, $id)
    {
        $user = Auth::user();
        $user = User::find($user->id);
        $page = Page::find($id);
        return $page->posts()->create([
            'title' => $request->title,
            'Content' => $request->Content,
            'type' => $request->type,
            'user_id' => $user->id
        ]);
    }
    public function create_post_from_community(Request $request, $id)
    {
        $user = Auth::user();
        $user = User::find($user->id);
        $community = Communities::find($id);
        return $community->posts()->create([
            'title' => $request->title,
            'Content' => $request->Content,
            'type' => $request->type,
            'user_id' => $user->id
        ]);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function get_myprofile_posts()
    {
        $user = Auth::user();
        $user = User::find($user->id);

        return $user->posts()->get();
    }


    public function edit_myprofile_posts(Request $request, $id)
    {
        $user = Auth::user();
        $user = User::find($user->id);


        $title = Post::where('user_id', $user->id)->where('id', $id)->value('title');
        $Content = Post::where('user_id', $user->id)->where('id', $id)->value('Content');
        $type = Post::where('user_id', $user->id)->where('id', $id)->value('type');


        $toedit =  $user->posts()->find($id);
        $fields = $request->validate([
            'type' => 'bail|string',
            'Content' => 'bail|string',
            'title' => 'bail|string',


        ]);
        $newtype = $request->type;
        $newContent = $request->Content;
        $newtitle = $request->title;


        if ($request->type == null) {
            $newtype = $type;
        } else {
            $newtype = $fields['type'];
        }

        if ($request->Content == null) {
            $newContent = $Content;
        } else {
            $newContent = $fields['Content'];
        }


        if ($request->title == null) {
            $newtitle = $title;
        } else {
            $newtitle = $fields['title'];
        }


        $toedit->update([
            'type' => $newtype,
            'Content' => $newContent,
            'title' => $newtitle,

        ]);

        $after = Post::where('user_id', $user->id)->where('id', $id)->get();
        return [$toedit, $after];
    }



    public function edit_mypage_posts(Request $request, $page_id, $post_id)
    {
        $user = Auth::user();
        $user = User::find($user->id);
        $page =   $user->Page()->find($page_id);

        $title = Post::where('user_id', $user->id)->where('id', $post_id)->value('title');
        $Content = Post::where('user_id', $user->id)->where('id', $post_id)->value('Content');
        $type = Post::where('user_id', $user->id)->where('id', $post_id)->value('type');

        $toedit =  $page->posts()->find($post_id);

        $fields = $request->validate([
            'type' => 'bail|string',
            'Content' => 'bail|string',
            'title' => 'bail|string',


        ]);
        $newtype = $request->type;
        $newContent = $request->Content;
        $newtitle = $request->title;


        if ($request->type == null) {
            $newtype = $type;
        } else {
            $newtype = $fields['type'];
        }

        if ($request->Content == null) {
            $newContent = $Content;
        } else {
            $newContent = $fields['Content'];
        }


        if ($request->title == null) {
            $newtitle = $title;
        } else {
            $newtitle = $fields['title'];
        }


        $toedit->update([
            'type' => $newtype,
            'Content' => $newContent,
            'title' => $newtitle,

        ]);

        $after = Post::where('user_id', $user->id)->where('id', $post_id)->get();
        return [$toedit, $after];
    }
    public function edit_mycommunity_posts(Request $request, $community_id, $post_id)
    {

        $user = Auth::user();
        $user = User::find($user->id);

        $community = Communities::find($community_id);
        $toedit = $community->posts()->find($post_id);

        $title = Post::where('user_id', $user->id)->where('id', $post_id)->value('title');
        $Content = Post::where('user_id', $user->id)->where('id', $post_id)->value('Content');
        $type = Post::where('user_id', $user->id)->where('id', $post_id)->value('type');


        $fields = $request->validate([
            'type' => 'bail|string',
            'Content' => 'bail|string',
            'title' => 'bail|string',


        ]);
        $newtype = $request->type;
        $newContent = $request->Content;
        $newtitle = $request->title;


        if ($request->type == null) {
            $newtype = $type;
        } else {
            $newtype = $fields['type'];
        }

        if ($request->Content == null) {
            $newContent = $Content;
        } else {
            $newContent = $fields['Content'];
        }


        if ($request->title == null) {
            $newtitle = $title;
        } else {
            $newtitle = $fields['title'];
        }


        $toedit->update([
            'type' => $newtype,
            'Content' => $newContent,
            'title' => $newtitle,

        ]);

        $after = Post::where('user_id', $user->id)->where('id', $post_id)->get();
        return [$toedit, $after];
    }
    public function get_mypage_posts($id)
    {
        $user = Auth::user();
        $user = User::find($user->id);
        $page =  $user->Page()->find($id);

        return $page->posts()->get();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function delete_profile_post($id)
    {
        $user = Auth::user();
        $user = User::find($user->id);
        $post = $user->posts()->find($id);
        $post->delete();
        return 'suc';
    }

    /**
     * Update the specified resource in storage.
     */
    public function delete_page_post($page_id, $post_id)
    {
        $user = Auth::user();
        $user = User::find($user->id);
        $page =   $user->Page()->find($page_id);
        $todelete =  $page->posts()->find($post_id);

        $todelete->delete();
        return 'suc';
    }
    public function delete_community_post($community_id, $post_id)
    {
        $user = Auth::user();
        $user = User::find($user->id);

        $community = Communities::find($community_id);
        $todelete = $community->posts()->find($post_id);

        $todelete->delete();
        return 'suc';
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
