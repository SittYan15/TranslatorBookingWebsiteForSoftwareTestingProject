@extends('layouts.app')

@section('title', 'Book Translator')

@push('styles')
    <style>
        body {
            background: linear-gradient(135deg, #e3e6ed 0%, #f8fafc 100%);
        }

        .profile-img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 50%;
            border: 3px solid #fff;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.10);
            margin-bottom: 1rem;
        }

        .booking-card {
            max-width: 520px;
            margin: 40px auto;
            border-radius: 1.5rem;
            box-shadow: 0 4px 24px rgba(40, 167, 69, 0.10);
            background: rgba(255, 255, 255, 0.97);
        }

        .profile-title {
            font-size: 1.3rem;
            font-weight: 700;
            margin-bottom: 0.2rem;
        }

        .profile-rating {
            font-size: 1.1rem;
            color: #ffc107;
        }

        .form-label {
            font-weight: 500;
        }
    </style>
@endpush

@section('content')

    <div class="booking-card card p-4">
        <div class="text-center mb-3">
            <img src="{{ asset($translator->profile ?? 'public/img/users/defaultProfile.avif') }}" alt="Profile"
                class="profile-img">
            <div class="profile-title">{{ $translator->name ?? 'Translator Name' }}</div>
            <div class="profile-rating mb-1">
                @for ($i = 1; $i <= 5; $i++)
                    @if ($i <= $translator->rating)
                        <i class="bi bi-star-fill"></i>
                    @else
                        <i class="bi bi-star"></i>
                    @endif
                @endfor
                <small class="text-muted ms-1">({{ $translator->rating ?? '4.5' }})</small>
            </div>
        </div>
        <hr>
        <form method="POST" action="{{ route('bookings.store') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="translator_id" value="{{ $translator->id }}">
            <div class="mb-3">
                <label for="service_id" class="form-label">Choose Service</label>
                <select class="form-select" name="service_id" id="service_id" required>
                    <option value="">Select a service</option>
                    @foreach ($translator->services as $service)
                        <option value="{{ $service->service_id }}">
                            {{ $service->language1 }} <i class="bi bi-arrow-left-right"></i> {{ $service->language2 }}
                            (&#36;{{ $service->price }})
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="booking_date" class="form-label">Date</label>
                <input type="date" class="form-control" name="booking_date" value="{{ $date }}" id="booking_date"
                    required>
            </div>
            <div class="mb-3">
                <label for="location" class="form-label">Location</label>
                <input type="text" class="form-control" name="location" id="location" placeholder="Enter location" required>
            </div>
            <div class="mb-3">
                <label for="booking_start_time" class="form-label">Start Time</label>
                <input type="time" class="form-control" name="booking_start_time" id="booking_start_time" required>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label for="duration_hrs" class="form-label">Duration (Hours)</label>
                    <input type="number" class="form-control" name="duration_hrs" id="duration_hrs" min="3"
                        max="12" required>
                </div>
                <div class="col">
                    <label for="duration_mins" class="form-label">Duration (Minutes)</label>
                    <input type="number" class="form-control" name="duration_mins" id="duration_mins" min="0"
                        max="59" required>
                </div>
            </div>
            <button type="submit" class="btn btn-success w-100">
                <i class="bi bi-calendar-plus"></i> Confirm Booking
            </button>
        </form>
    </div>
@endsection
