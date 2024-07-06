<?php

namespace App\Http\Controllers;

use App\Models\Athlete;
use App\Models\Guardian;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuardianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $guardian = Guardian::where('user_id', Auth::user()->id)->first();
        $athletes = Athlete::where('guardian_id', $guardian->id)->get();
        return view('usertype.guardian_landing', compact('athletes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public static function create(User $user)
    {
        $guardian = new Guardian();
        $guardian->name = $user->name;
        $guardian->user_id = $user->id;
        $guardian->save();
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
    public function show(Guardian $guardian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Guardian $guardian)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Guardian $guardian)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Guardian $guardian)
    {
        //
    }
}
