<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\AthleteController;
use App\Http\Controllers\CoachController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\GuardianController;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'user_type' => $request->user_type
        ]);

        event(new Registered($user));
        
        if ($user->user_type == "athlete") {
            AthleteController::create($user);
        } else if ($user->user_type == "coach") {
            CoachController::create($user);
        } else if ($user->user_type == "guardian") {
            GuardianController::create($user);
        }
        

        Auth::login($user);

        $user_type = Auth::user()->user_type;
        
        if ($user_type == "coach") {
            return redirect('/coach_landing');
        }
        if ($user_type == "athlete") {
            return redirect('/athlete_landing');
        }
        if ($user_type == "guardian") {
            return redirect('/guardian_landing');
        }

        // return redirect(route('dashboard', absolute: false));
    }
}
