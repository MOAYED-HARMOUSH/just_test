<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;

class PageController extends Controller
{use HasApiTokens;
    /**
     * Display a listing of the resource.
     */
    public function get_my_pages()
    {
        $user=Auth::user();
        $user=User::find($user->id);
      return  $user->Page()->get();

    }

    /**
     *
     * Show the form for creating a new resource.
     */
    public function create_page(Request $request)
    {
        $user=Auth::user();
        $fields=$request->validate([
            'email'=> 'bail|required|string',
            'bio'=>'bail|required|string',
            'cover_image'=>'bail|required|string',
            'image_name'=>'bail|required|string',
            'type'=>'bail|required|string',
            'name'=>'bail|required|string',

        ]);
     return   $page=Page::create([
            'email'=>$fields['email'],
            'bio'=>$fields['bio'],
            'cover_image'=>$fields['cover_image'] ,
            'image_name'=>$fields['image_name'],
            'type'=>$fields['type'],
            'name'=>$fields['name'],
            'admin_id'=>$user->id
          ]);
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
    public function show(Page $page)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit_my_page(Request $request, $id)
    {
       $user=Auth::user();
       $user=User::find($user->id);
       
       $email= Page::where('admin_id',$user->id)->where('id',$id)->value('email');
       $bio= Page::where('admin_id',$user->id)->where('id',$id)->value('bio');
       $cover_image= Page::where('admin_id',$user->id)->where('id',$id)->value('cover_image');
       $image_name= Page::where('admin_id',$user->id)->where('id',$id)->value('image_name');
       $type= Page::where('admin_id',$user->id)->where('id',$id)->value('type');
       $name= Page::where('admin_id',$user->id)->where('id',$id)->value('name');

         $toedit=  $user->Page()->find($id);
        $fields=$request->validate([
            'email'=> 'bail|string',
            'bio'=>'bail|string',
            'cover_image'=>'bail|string',
            'image_name'=>'bail|string',
            'type'=>'bail|string',
            'name'=>'bail|string',

        ]);
        $newemail=$request->email;
        $newbio=$request->bio;
        $newcover_image=$request->cover_image;
        $newimage_name=$request->image_name;
        $newtype=$request->type;
        $newname=$request->name;


        if($request->email==null) { $newemail = $email;}
        else{ $newemail=$fields['email'];}

       if($request->name==null) {  $newname = $name;}
        else{  $newname=$fields['name'];}


        if($request->type==null){ $newtype = $type;}
        else{ $newtype=$fields['type'];}

        if($request->image_name==null) { $newimage_name = $image_name;}
        else{ $newimage_name=$fields['image_name'];}

        if($request->cover_image==null){ $newcover_image = $cover_image;}
        else{ $newcover_image=$fields['cover_image'];}

        if($request->bio==null) { $newbio = $bio;}
        else{ $newbio=$fields['bio'];}

           $toedit->update([
            'email'=> $newemail,
            'bio'=>$newbio,
            'cover_image'=>$newcover_image ,
            'image_name'=>$newimage_name,
            'type'=>$newtype,
            'name'=>$newname,

          ]);

       return   Page::where('admin_id',$user->id)->where('id',$id)->get();

    }


    public function delete_page($id)
    {
        $user=Auth::user();
        $user=User::find($user->id);
        $del = Page::where('admin_id', $user->id)->where('id', $id)->first();
if (!$del) {
    return 'donkey';
} else {
    $del->delete();
    return 'Page deleted successfully';
}}

    /**
     * Remove the specified resource from storage.
     */
    public function getmediapages()
    {
    return Page::all();
    }
}
