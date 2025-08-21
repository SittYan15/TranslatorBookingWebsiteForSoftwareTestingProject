<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Translator Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            background-color: #f8f9fa;
        }
        .translator-card img {
            height: 200px;
            object-fit: cover;
        }
    </style>
</head>
<body>
<div class="container my-5">
    <h2 class="mb-4 text-center">Hire Translators</h2>

    <!-- Search Box -->
    <form method="GET" action="" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" value="{{ $search ?? '' }}" class="form-control" placeholder="Search translators by name or skill">
            <button class="btn btn-primary" type="submit">Search</button>
        </div>
    </form>

    <!-- Translators Grid -->
    <div class="row">
        {{-- @forelse($translators as $translator)
            <div class="col-md-4 mb-4">
                <div class="card translator-card">
                    <img src="{{ asset('storage/'.$translator->photo) }}" class="card-img-top" alt="{{ $translator->name }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $translator->name }}</h5>
                        <p class="card-text"><strong>Skill:</strong> {{ $translator->skill }}</p>
                        <a href="#" class="btn btn-success w-100">Hire</a>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center">No translators found.</p>
        @endforelse --}}
    </div>
</div>
</body>
</html>
