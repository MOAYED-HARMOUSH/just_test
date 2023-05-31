<?php

namespace App\Http\Controllers;

use App\Models\Follow_Page;
use App\Models\Page;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowPageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     */
    public function follow_page($id)
    {
        $user = Auth::user();

        $testifadmin = Page::where('admin_id', $user->id)->pluck('id');
        foreach ($testifadmin as $key => $value) {
            if ($id == $value)
                return 'admin of the page cant follow ';
        }

        $testid = Page::where('id', $id)->value('id');
        if (!$testid) {
            return 'undefind';
        } else {
            $test = Follow_Page::where('user_id', $user->id)->where('page_id', $id)->value('id');
            if (!$test) {
                Follow_Page::create([
                    'user_id' => $user->id,
                    'page_id' => $id
                ]);
                return 'followed';
            } else return 'already followed';
        }
    }
    /**
     * Store a newly created resource in storage.
     */
    public function unfollowpage($id)
    {
        $user = Auth::user();

        $testifadmin2 = Page::where('admin_id', $user->id)->pluck('id');
        foreach ($testifadmin2 as $key => $value) {
            if ($id == $value)
                return 'admin of the page cant unfollow ';
        }
        $testid = Page::where('id', $id)->value('id');
        if (!$testid) {
            return 'undefind';
        } else {
            $test = Follow_Page::where('user_id', $user->id)->where('page_id', $id)->value('id');
            if ($test) {
                $ww = Follow_Page::where('user_id', $user->id)->where('page_id', $id)->delete();
                return 'unfollowed';
            } else return 'already unfollowed';
        }
    }

    /**
     * Display the specified resource.
     */
    public function getmyfollowpages()
    {
        $user = Auth::user();
        $user2 = User::find($user->id);

        return $user2->Follow_Page()->get();
        //    $a=$user2->Follow_Page()->pluck('id');
        //    return $pages = Page::whereIn('id', $a)->get();


    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Follow_Page $follow_Page)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Follow_Page $follow_Page)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Follow_Page $follow_Page)
    {
        //
    }
}
