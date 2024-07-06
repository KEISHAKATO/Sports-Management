<?php

namespace App\Http\Controllers;

use App\Models\Athlete;
use App\Models\Coach;
use App\Models\Guardian;
use App\Models\User;
use Illuminate\Http\Request;

class AthleteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $guardians = Guardian::all();
        $coaches = Coach::all();
        return view('usertype.athlete_landing', compact('guardians', 'coaches'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public static function create(User $user)
    {
        $athlete = new Athlete();
        $athlete->name = $user->name;
        $athlete->user_id = $user->id;
        $athlete->save();
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
    public function show(Athlete $athlete)
    {
        //
    }

    public function fetchAthleteData($athlete_id) {
        $athlete = Athlete::where('id', $athlete_id)->first();
        return response()->json($athlete);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Athlete $athlete)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Athlete $athlete)
    {
        $athlete->training_plans = $request->training_plans;
        $athlete->objectives = $request->goal_setting;
        $athlete->health_tips = $request->nutrition_health_tips;
        $athlete->awards = $request->awards;
        $athlete->save();
    }

    public function updateAthleteDetails($id, Request $request) {
        $athlete = Athlete::where('user_id', $id)->first();
        $athlete->dob = $request->dob;
        $athlete->address = $request->address;
        $athlete->guardian_id = $request->guardian_id;
        $athlete->coach_id = $request->coach_id;
        $athlete->save();
        return redirect('/athlete_landing');
    }

    public function updateAthleteCoach(Request $request) {
        $athlete = Athlete::where('id', $request->athlete_id)->first();
        $this->update($request, $athlete);
        return redirect('/coach_landing');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Athlete $athlete)
    {
        //
    }
}
