@php
    $athlete = Auth::user()->athlete;
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Athlete Dashboard</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding-top: 20px;
        }
        .container {
            max-width: 800px;
        }
        .card {
            margin-bottom: 20px;
        }
        .pre-wrap {
            white-space: pre-line;
        }
    </style>
</head>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

<body>
    <div class="container">
        <h1 class="text-center">Athlete Dashboard</h1>
        
        <!-- Display Athlete Name -->
        <div class="card">
            <div class="card-header">
                <h3>{{ Auth::user()->name }}</h3>
            </div>
        </div>

        <!-- Form to Update Date of Birth and Address -->
        <div class="card">
            <div class="card-header">
                <h3>Update Information</h3>
            </div>
            <div class="card-body">
                <form action="{{route('athlete.updatePersonal', ['id' => Auth::user()->id])}}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="form-group">
                        <label for="dob">Date of Birth</label>
                        <input type="date" id="dob" name="dob" class="form-control" value="{{ Auth::user()->athlete->dob }}">
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" id="address" name="address" class="form-control" value="{{ Auth::user()->athlete->address }}">
                    </div>
                    <div class="form-group">
                        <label for="athlete">Select Guardian</label>
                        <select id="athlete" name="guardian_id" class="form-control">
                            <option value="" selected disabled>Select your guardian</option>
                            @foreach($guardians as $guardian)
                                @if ($guardian->id == $athlete->guardian_id)
                                <option value="{{ $guardian->id }}" selected>{{ $guardian->name }}</option>
                                @else
                                <option value="{{ $guardian->id }}">{{ $guardian->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="athlete">Select Coach</label>
                        <select id="athlete" name="coach_id" class="form-control">
                            <option value="" selected disabled>Select your coach</option>
                            @foreach($coaches as $coach)
                                @if ($coach->id == $athlete->coach_id) 
                                <option value="{{ $coach->id }}" selected>{{ $coach->name }}</option>
                                @else
                                <option value="{{ $coach->id }}">{{ $coach->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>

        <!-- Display Training Plans -->
        <div class="card">
            <div class="card-header">
                <h3>Training Plans</h3>
            </div>
            <div class="card-body">
                <p class="pre-wrap">{{ Auth::user()->athlete->training_plans }}</p>
            </div>
        </div>

        <!-- Display Goal Setting -->
        <div class="card">
            <div class="card-header">
                <h3>Goal Setting</h3>
            </div>
            <div class="card-body">
                <p class="pre-wrap">{{ Auth::user()->athlete->objectives }}</p>
            </div>
        </div>

        <!-- Display Nutrition and Health Tips -->
        <div class="card">
            <div class="card-header">
                <h3>Nutrition and Health Tips</h3>
            </div>
            <div class="card-body">
                <p class="pre-wrap">{{ Auth::user()->athlete->health_tips }}</p>
            </div>
        </div>

        <!-- Display Awards -->
        <div class="card">
            <div class="card-header">
                <h3>Awards</h3>
            </div>
            <div class="card-body">
                <p class="pre-wrap">{{ Auth::user()->athlete->awards }}</p>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

</x-app-layout>
