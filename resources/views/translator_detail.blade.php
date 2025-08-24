<!-- filepath: /Applications/XAMPP/xamppfiles/htdocs/ST_TranslatorWebsite/resources/views/translator_detail.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Translator Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        .profile-bg {
            background-image: url('{{ asset($bg_image ?? "img/website/auth_background.jpg") }}');
            background-size: cover;
            background-position: center;
            height: 300px;
            position: relative;
        }
        .profile-img {
            width: 160px;
            height: 160px;
            object-fit: cover;
            border-radius: 50%;
            border: 5px solid #fff;
            position: absolute;
            left: 50%;
            bottom: -80px;
            transform: translateX(-50%);
            background: #fff;
        }
        .profile-card {
            margin-top: 100px;
        }
    </style>
</head>
<body>
    <div class="profile-bg">
        <img src="{{ asset($translator->profile ?? 'img/users/defaultProfile.avif') }}" alt="Profile" class="profile-img shadow">
    </div>
    <div class="container profile-card">
        <div class="card p-4">
            <div class="text-center mb-3">
                <h2>{{ $translator->name ?? 'Translator Name' }}</h2>
                <div>
                    <span class="text-warning">
                        @for ($i = 0; $i < floor($translator->rating ?? 4.5); $i++)
                            <i class="bi bi-star-fill"></i>
                        @endfor
                        @if (isset($translator->rating) && $translator->rating - floor($translator->rating) >= 0.5)
                            <i class="bi bi-star-half"></i>
                        @endif
                    </span>
                    <small class="text-muted">({{ $translator->rating ?? '4.5' }})</small>
                </div>
            </div>
            <hr>
            <div>
                <h5>About</h5>
                <p>{{ $translator->bio ?? 'Experienced translator with expertise in multiple languages and fields.' }}</p>
                <h5>Skills</h5>
                <ul>
                    @foreach(($translator->skills ?? ['English', 'Burmese', 'Technical', 'Legal']) as $skill)
                        <li>{{ $skill }}</li>
                    @endforeach
                </ul>
                <h5>Contact</h5>
                <p>Email: {{ $translator->email ?? 'translator@example.com' }}</p>
            </div>
        </div>
    </div>
</body>
</html>
