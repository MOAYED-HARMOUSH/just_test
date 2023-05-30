<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function create_commente_on_post(Request $request ,$id)
    {
    $user=Auth::user();
   return  Comments::create([
        'content'=>$request->content,
        'post_id'=>$id,
        'commenter_id'=>$user->id
    ]);
    ///////////////
    }

    /**
     * Show the form for creating a new resource.
     */
    public function delete_commente_on_post($post_id,$comment_id)
    {
        $user=Auth::user();
        $user=User::find($user->id);
       return $user->Comments()->where('id',$comment_id)->delete();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function edit_commente_on_post(Request $request,$post_id,$comment_id)
    {// كمله
        $user=Auth::user();
        $user=User::find($user->id);

    }

    /**
     * Display the specified resource.
     */
    public function show(Comments $comments)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comments $comments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comments $comments)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comments $comments)
    {
        //
    }
}
