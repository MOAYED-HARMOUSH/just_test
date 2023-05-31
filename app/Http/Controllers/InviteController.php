<?php

namespace App\Http\Controllers;

use App\Models\Invite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class InviteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function invie_friend_to_page(Request $request, $id)
    {
        $user = Auth::user();
        $user = User::find($user->id);
        //    return Request_Media::all();
        $test = Invite::where('sender_invite', $user->id)->where('reciever_invite', $id)->value('id');
        if ($test == null) {
            $request_media = Invite::create([
                'sender_invite' => $user->id,
                'reciever_invite' => $id,
                'page_invite_id' => $request->page_invite_id,
            ]);
            return $request_media->save();
        } else
            return 'already invite him';
    }
    public function getmyinvitestome()
    {
        $user = Auth::user();
        $user = User::find($user->id);
        //    return Request_Media::all();
        return  $test = Invite::where('reciever_invite', $user->id)->get();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function getmyinvitestopeople()
    {
        $user = Auth::user();
        $user = User::find($user->id);
        //    return Request_Media::all();
        return  $test = Invite::where('sender_invite', $user->id)->get();
    }
    /**
     * Show the form for creating a new resource.
     */
    public function accept_invite(Request $request, $id)
    { // acccept/decline  // اعمل is approved وتحقق بالكويري
        $user = Auth::user();
        $user = User::find($user->id);
        $tosenderifacceptornot = $request->is_approved;
        if ($tosenderifacceptornot == 1) {
            // ارسال اشعار للمرسل بالقبول
        } else {
            // ارسال اشعار للمرسل بالرفض

        }
        $test = Invite::where('reciever_invite', $user->id)->get();
        $sender = Invite::where('reciever_invite', $user->id)->value('sender_invite');
        Invite::where('sender_invite', $id)->update(
            [
                'is_approved' => $request->is_approved,
            ]
        );
        return Invite::find($id);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function getallinvites()
    {
        return Invite::all();
    }

    /**
     * Display the specified resource.
     */
    public function show(Invite $invite)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invite $invite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Invite $invite)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invite $invite)
    {
        //
    }
}
