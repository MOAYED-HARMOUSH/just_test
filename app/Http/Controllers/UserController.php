<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function getall($id)
    {// show info about user
        $user = User::find($id);
        $st =  $user->Student()->get();
        $ex =  $user->Expert()->get();
        return [$user, $st, $ex];
    }

    public function create_user(Request $request)
    {

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,

            'email' => $request->email,
            'password' => $request->password,
            'password_confirmation' => $request->password_confirmation,
            'image_name' => $request->image_name,
            'country' => $request->country,
            'programming_age' => $request->programming_age,
            'bio' => $request->bio,
            'phone_number' => $request->phone_number,

            'current_location' => $request->current_location,
            'gender' => $request->first_name,
            'birth_date' => $request->birth_date
        ]);
        $token = $user->createToken('person token')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token,
        ];

        return response($response, 201);
    }

    public function login(Request $request)
    {

        $fields = $request->validate([
            'email' => '|bail|string',
            'password' => 'bail|required|string',
        ]);

        $user = User::where('email', $fields['email'])->first();

        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return response(['message' => "bad"], 401);
        }

        $token = $user->createToken('login token')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token,
        ];

        return response($response, 201);
    }
    public function getallusers()
    {
        return User::all();
    }
}
