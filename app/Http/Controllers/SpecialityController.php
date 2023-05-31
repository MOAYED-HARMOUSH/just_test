<?php

namespace App\Http\Controllers;

use App\Models\Communities;
use App\Models\Knowledge;
use App\Models\Speciality;
use App\Models\Subscribe_Communities;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SpecialityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function createSpeciality(Request $request)
    {
        $user = Auth::user();
        $speciality = Speciality::create([
            'Speciality' => $request->Speciality,
            'department' => $request->department,
            'Language' => $request->Language,
            'framework' => $request->framework,
            'started_at' => $request->started_at,
        ]);
        $spa_id = $speciality->pluck('id')->last();
        $kn = Knowledge::create([
            'User_id' => $user->id,
            'specilaty_id' =>  $spa_id
        ]);
        $Communities_id = Communities::where('name', $request->Speciality)->value('id');
        $Communities_subscribers = Communities::where('id', $Communities_id)->value('subscriber_counts');

        Subscribe_Communities::create([
            'user_id' => $user->id,
            'Community_id' => $Communities_id,
        ]);
        $Communities_subscribers = Communities::where('id', $Communities_id)->value('subscriber_counts');

        $counter = Communities::where('id', $Communities_id)->update([
            'subscriber_counts' => $Communities_subscribers + 1

        ]);
        //return $counter=$counter+1;
        return [$speciality, $kn];
    }

    /**
     * Show the form for creating a new resource.
     */
    public function getmyspechilities()
    {
        $user = Auth::user();
        $k =  Knowledge::where('user_id', $user->id)->pluck('specilaty_id');
        $a = Speciality::whereIn('id', $k)->get();
        return $a; // الاحسن نحط ال started at بال سبشليتي مشان الريسبونس
        // way2
        // foreach ($k as $key => $value) {
        //    echo Speciality::where('id',$value)->get();
        // }
    }


    /**
     * Store a newly created resource in storage.
     */
    public function deletemyspechilities($id)
    {
        $user = Auth::user();
        $k =  Knowledge::where('user_id', $user->id)->where('specilaty_id', $id);
        $a = Speciality::where('id', $id)->delete();

        return 'deleted';
    }

    /**
     * Display the specified resource.
     */
    public function editmyspechilities(Request $request, $id)
    {
        $user = Auth::user();
        $specilaty_info = Speciality::where('id', $id)->get();

        $Speciality = Speciality::where('id', $id)->value('Speciality');
        $department = Speciality::where('id', $id)->value('department');
        $framework = Speciality::where('id', $id)->value('framework');
        $Language = Speciality::where('id', $id)->value('Language');
        $started_at = Speciality::where('id', $id)->value('started_at');

        $specilaty_info = Speciality::where('id', $id)->get();
        $fields = $request->validate([
            'Speciality' => 'bail|string',
            'department' => 'bail|string',
            'framework' => 'bail|string',
            'Language' => 'bail|string',
            'started_at' => 'bail|string',

        ]);
        $newSpeciality = $request->Speciality;
        $newdepartment = $request->department;
        $newframework = $request->framework;
        $newLanguage = $request->Language;
        $newnstarted_at = $request->started_at;


        if ($request->Speciality == null) {
            $newSpeciality = $Speciality;
        } else {
            $newSpeciality = $fields['Speciality'];
        }

        if ($request->department == null) {
            $newdepartment = $department;
        } else {
            $newdepartment = $fields['department'];
        }

        if ($request->framework == null) {
            $newframework = $framework;
        } else {
            $newframework = $fields['framework'];
        }

        if ($request->Language == null) {
            $newLanguage = $Language;
        } else {
            $newLanguage = $fields['Language'];
        }

        if ($request->started_at == null) {
            $newstarted_at = $started_at;
        } else {
            $newstarted_at = $fields['started_at'];
        }


        Speciality::where('id', $id)->update([
            'Speciality' => $newSpeciality,
            'department' => $newdepartment,
            'framework' => $newframework,
            'Language' => $newLanguage,
            'started_at' => $newstarted_at,
        ]);
        return Speciality::where('id', $id)->get();
    }


    public function edit(Speciality $speciality)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Speciality $speciality)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Speciality $speciality)
    {
        //
    }
}
