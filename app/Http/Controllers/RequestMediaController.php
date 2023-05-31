<?php

namespace App\Http\Controllers;

use App\Models\Request_Media;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RequestMediaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */

     public function add_friend($id)
     {
         $user=Auth::user();
         $user = User::find($user->id);
    //    return Request_Media::all();
         $test= Request_Media::where('sender',$user->id)->where('reciever',$id)->value('id');
         if($test==null)
         {
        $request_media= Request_Media::create([
            'sender' => $user->id,
            'reciever' => $id,
            'is_approved' => false,
        ]);
       return $request_media->save();}
       else
        return 'already sent';



     }

    /**
     * Store a newly created resource in storage.
     */
    public function accept_friend(Request $request,$id)
    { // acccept/decline
        $user=Auth::user();
        $user = User::find($user->id);
   //    return Request_Media::all();
        $test= Request_Media::where('reciever',$user->id)->get();
          $sender= Request_Media::where('reciever',$user->id)->value('sender');
        Request_Media::where('sender',$id)->update(
            [
                'is_approved' => $request->is_approved,
            ]
            );
            return Request_Media::find($id);

    }

    /**
     * Display the specified resource.
     */
    public function getrequeststome()
    {
        $user=Auth::user();
        $user = User::find($user->id);
   //    return Request_Media::all();
      return  $test= Request_Media::where('reciever',$user->id)->get();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function getrequeststopeople()
    {
        $user=Auth::user();
        $user = User::find($user->id);
   //    return Request_Media::all();
      return  $test= Request_Media::where('sender',$user->id)->get();
    }

    /**
     * Update the specified resource in storage.
     */
    public function invitetopage(Request $request, $user_id)
    {
        $user=Auth::user();

        $user = User::find($user->id);
      return  Request_Media::create([
            'sender' => $user->id,
            'reciever' => $user_id,
            'is_approved' => false,

        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request_Media $request_Media)
    {
        //
    }
}
