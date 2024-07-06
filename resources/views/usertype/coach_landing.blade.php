@php

// $athletes = Athlete::all();

@endphp

<!-- resources/views/coach.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coach Dashboard</title>
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
        <h1 class="text-center">Coach Dashboard</h1>

        <!-- Form to Select Athlete and Update Information -->
        <div class="card">
            <div class="card-header">
                <h3>Update Athlete Information</h3>
            </div>
            <div class="card-body">
                <form id="update-athlete-form" action="{{ route('coach.updateAthlete') }}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="form-group">
                        <label for="athlete">Select Athlete</label>
                        <select id="athlete" name="athlete_id" class="form-control" required>
                            <option value="" selected disabled>Select an athlete</option>
                            @foreach($athletes as $athlete)
                                <option value="{{ $athlete->id }}">{{ $athlete->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="training_plans">Training Plans</label>
                        <textarea id="training_plans" name="training_plans" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="goal_setting">Goal Setting</label>
                        <textarea id="goal_setting" name="goal_setting" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="nutrition_health_tips">Nutrition and Health Tips</label>
                        <textarea id="nutrition_health_tips" name="nutrition_health_tips" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="awards">Awards</label>
                        <textarea id="awards" name="awards" class="form-control"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#athlete').change(function() {
                var athleteId = $(this).val();
                if (athleteId) {
                    $.ajax({
                        url: '/getAthleteData/' + athleteId,
                        method: 'GET',
                        success: function(data) {
                            $('#training_plans').text(data.training_plans);
                            $('#goal_setting').text(data.objectives);
                            $('#nutrition_health_tips').text(data.health_tips);
                            $('#awards').text(data.awards);
                        },
                        error: function() {
                            alert('Error retrieving athlete data');
                        }
                    });
                } else {
                    $('#update-athlete-form').trigger("reset");
                }
            });
        });
    </script>
</body>
</html>

</x-app-layout>
