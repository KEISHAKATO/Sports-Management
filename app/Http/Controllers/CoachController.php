<?php

namespace App\Http\Controllers;

use App\Models\Athlete;
use App\Models\Coach;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CoachController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $coach = Coach::where('user_id', Auth::user()->id)->first();
        $athletes = Athlete::where('coach_id', $coach->id)->get();
        return view('usertype.coach_landing', compact('athletes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public static function create(User $user)
    {
        $coach = new Coach();
        $coach->name = $user->name;
        $coach->user_id = $user->id;
        $coach->save();
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
    public function show(Coach $coach)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Coach $coach)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Coach $coach)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Coach $coach)
    {
        //
    }
}
