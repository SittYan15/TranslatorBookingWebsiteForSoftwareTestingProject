@extends('layouts.app')

@section('title', 'Translator Profile')

@push('styles')
    <style>
        body {
            background: linear-gradient(135deg, #e3e6ed 0%, #f8fafc 100%);
        }

        .profile-bg {
            background-image: url('{{ asset($bg_image ?? 'img/website/auth_background.jpg') }}');
            background-size: cover;
            background-position: center;
            height: 220px;
            position: relative;
        }

        .profile-img {
            width: 250px;
            height: 250px;
            object-fit: cover;
            border-radius: 50%;
            border: 4px solid #fff;
            position: absolute;
            left: 50%;
            bottom: -60px;
            transform: translateX(-50%);
            background: #fff;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.10);
        }

        .profile-card {
            margin-top: 70px;
            max-width: 500px;
        }

        .status-dot {
            height: 10px;
            width: 10px;
            border-radius: 50%;
            display: inline-block;
            margin-right: 6px;
        }

        .status-online {
            background: #28a745;
        }

        .status-offline {
            background: #dc3545;
        }

        .service-badge {
            font-size: 0.92rem;
            margin: 2px;
            padding: 0.5em 0.8em;
            border-radius: 1em;
        }

        .card {
            border-radius: 1.5rem;
        }

        .btn-book {
            font-weight: 500;
            letter-spacing: 0.5px;
            box-shadow: 0 2px 8px rgba(40, 167, 69, 0.08);
        }

        .profile-header {
            margin-bottom: 0.5rem;
        }

        .profile-title {
            font-size: 1.7rem;
            font-weight: 700;
            letter-spacing: 0.5px;
        }

        .profile-section-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: #495057;
        }

        .profile-section {
            background: #f7f9fb;
            border-radius: 1rem;
            padding: 1rem;
            margin-bottom: 1rem;
        }
    </style>
@endpush

@section('content')
    <div class="profile-bg">
        <img src="{{ asset($translator->profile ?? 'public/img/users/defaultProfile.avif') }}" alt="Profile"
            class="profile-img shadow">
    </div>
    <div class="container d-flex justify-content-center profile-card">
        <div class="card p-4 shadow-lg w-100">
            <div class="text-center profile-header">
                <div class="profile-title mb-1">{{ $translator->name ?? 'Translator Name' }}</div>
                <div class="mb-2">
                    <span>
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= $translator->rating)
                                <i class="bi bi-star-fill text-warning"></i>
                            @else
                                @if ($translator->rating - floor($translator->rating) >= 0.5 && $i == ceil($translator->rating))
                                    <i class="bi bi-star-half text-warning"></i>
                                @else
                                    <i class="bi bi-star text-warning"></i>
                                @endif
                            @endif
                        @endfor
                    </span>
                    <small class="text-muted ms-1">({{ $translator->rating ?? '4.5' }})</small>
                </div>
                <div class="mb-2">
                    @if (($translator->status ?? 1) == 1)
                        <span class="status-dot status-online"></span>
                        <span class="text-success fw-semibold">Active</span>
                    @else
                        <span class="status-dot status-offline"></span>
                        <span class="text-danger fw-semibold">Inactive</span>
                    @endif
                </div>
                <a href="{{ route('bookings.create', ['translator_id' => encrypt($translator->id), 'date' => now()->format('Y-m-d')]) }}"
                    class="btn btn-success btn-book px-4 mt-2">
                    <i class="bi bi-calendar-plus"></i> Book Now
                </a>
            </div>
            <hr>
            <div class="profile-section">
                <div class="profile-section-title mb-2"><i class="bi bi-info-circle"></i> About</div>
                <p class="mb-0">
                    {{ $translator->bio ?? 'Experienced translator with expertise in multiple languages and fields.' }}
                </p>
            </div>
            <div class="profile-section">
                <div class="profile-section-title mb-2"><i class="bi bi-award"></i> Services</div>
                <div>
                    @if (!empty($translator->services))
                        @foreach ($translator->services as $service)
                            <span class="badge bg-primary service-badge">
                                {{ $service->language1 }} <i class="bi bi-arrow-left-right"></i>
                                {{ $service->language2 }}
                                <span class="ms-1 text-light">(฿{{ $service->price }})</span>
                            </span>
                        @endforeach
                    @else
                        <span class="text-muted">No services listed.</span>
                    @endif
                </div>
            </div>
            <div class="profile-section">
                <div class="profile-section-title mb-2"><i class="bi bi-envelope"></i> Contact</div>
                <p class="mb-0">Email: <a
                        href="mailto:{{ $translator->email ?? 'translator@example.com' }}">{{ $translator->email ?? 'translator@example.com' }}</a>
                </p>
            </div>
        </div>
    </div>
@endsection
