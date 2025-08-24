<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Translator Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
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
                <input type="text" name="search" value="{{ $search ?? '' }}" class="form-control"
                    placeholder="Search translators by name or skill">
                <button class="btn btn-primary" type="submit">Search</button>
            </div>
        </form>

        <!-- Translators Grid -->
        <div class="row">
            @for ($i = 0; $i < 5; $i++)
                <div class="col-md-4 mb-4">
                    <div class="card translator-card">
                        {{-- <img src="" class="card-img-top" alt="translator"> --}}
                        <img src="https://www.lemon8-app.com/seo/image?item_id=7459183019119608362&index=7&sign=c3ea9ea63e8c41d067e3d77b1e653a42"
                            alt="translator" class="img-fluid">
                        <div class="card-body">
                            <h5 class="card-title">Mr. Sitt Yan Htun</h5>
                            <div class="mb-2">
                                <h6 class="d-inline">Ratings:</h6>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-half text-warning"></i>
                                <small class="text-muted">(4.5)</small>
                            </div>
                            <p class="card-text"><strong>Skill:</strong> skills </p>
                            <div class="container text-center">
                                <div class="row">
                                    <div class="col-6">
                                        <a href="#" class="btn btn-info w-100">Details</a>
                                    </div>
                                    <div class="col-6">
                                        <a href="#" class="btn btn-success w-100">Bookings</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- @empty
                    <p class="text-center">No translators found.</p> --}}
            @endfor
        </div>
    </div>
</body>

</html>
