<!-- resources/views/parent.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parent Dashboard</title>
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
        <h1 class="text-center">Parent Dashboard</h1>

        <!-- Form to Select Athlete -->
        <div class="card">
            <div class="card-header">
                <h3>Select Athlete</h3>
            </div>
            <div class="card-body">
                <form id="select-athlete-form">
                    @csrf
                    <div class="form-group">
                        <label for="athlete">Select Athlete</label>
                        <select id="athlete" name="athlete_id" class="form-control" required>
                            <option value="" selected disabled>Select an athlete</option>
                            @foreach($athletes as $athlete)
                                <option value="{{ $athlete->id }}">{{ $athlete->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </form>
            </div>
        </div>

        <!-- Display Athlete Information -->
        <div id="athlete-info" class="d-none">
            <div class="card">
                <div class="card-header">
                    <h3>Training Plans</h3>
                </div>
                <div class="card-body">
                    <p class="pre-wrap" id="training_plans"></p>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3>Goal Setting</h3>
                </div>
                <div class="card-body">
                    <p class="pre-wrap" id="goal_setting"></p>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3>Nutrition and Health Tips</h3>
                </div>
                <div class="card-body">
                    <p class="pre-wrap" id="nutrition_health_tips"></p>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3>Awards</h3>
                </div>
                <div class="card-body">
                    <p class="pre-wrap" id="awards"></p>
                </div>
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
                            $('#athlete-info').removeClass('d-none');
                        }
                    });
                } else {
                    $('#athlete-info').addClass('d-none');
                }
            });
        });
    </script>
</body>
</html>

</x-app-layout>
