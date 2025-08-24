@extends('layouts.app')

@section('title', 'Translator Profile')

@push('styles')
    <style>
        body {
            background-color: #f8f9fa;
        }

        .translator-card img {
            width: 60%;
            aspect-ratio: 1 / 1;
            object-fit: cover;
            border-top-left-radius: 0.375rem;
            border-top-right-radius: 0.375rem;
            display: block;
            margin-left: auto;
            margin-right: auto;
            margin-top: 1rem;
        }
    </style>
@endpush

@section('content')
    <div class="container my-2">
        <h1 class="mb-4 text-center">Hire Translators</h1>

        <!-- Search Box -->
        <form method="GET" action="{{ route('search.name') }}" class="mb-4" enctype="multipart/form-data">
            @csrf
            <div class="input-group">
                <input type="text" name="search" value="{{ $search ?? '' }}" class="form-control"
                    placeholder="Search translators by name">
                <button class="btn btn-primary" type="submit">Search</button>
            </div>
        </form>

        <!-- Search & Filter Card -->
        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <form method="GET" action="{{ route('search.filter') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-3 align-items-end">
                        <!-- Date -->
                        <div class="col-md-2">
                            <label for="date" class="form-label mb-1"><i class="bi bi-calendar-event"></i>
                                Date</label>
                            <input type="date" class="form-control" name="date" id="date"
                                value="{{ request('date') }}">
                        </div>
                        <!-- Language 1 -->
                        <div class="col-md-2">
                            <label for="language1" class="form-label mb-1"><i class="bi bi-translate"></i> Language
                                1</label>
                            <select class="form-select" name="language1" id="language1">
                                <option value="">All</option>
                                @foreach ($languages as $language)
                                    <option value="{{ $language->id }}"
                                        {{ request('language1') == $language->id ? 'selected' : '' }}>
                                        {{ $language->language }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <!-- Language 2 -->
                        <div class="col-md-2">
                            <label for="language2" class="form-label mb-1"><i class="bi bi-translate"></i> Language
                                2</label>
                            <select class="form-select" name="language2" id="language2">
                                <option value="">All</option>
                                @foreach ($languages as $language)
                                    <option value="{{ $language->id }}"
                                        {{ request('language2') == $language->id ? 'selected' : '' }}>
                                        {{ $language->language }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <!-- Rating -->
                        <div class="col-md-2">
                            <label for="rating" class="form-label mb-1"><i class="bi bi-star-fill text-warning"></i>
                                Min Rating</label>
                            <select class="form-select" name="rating" id="rating">
                                <option value="">Any</option>
                                @for ($i = 5; $i >= 1; $i--)
                                    <option value="{{ $i }}" {{ request('rating') == $i ? 'selected' : '' }}>
                                        {{ $i }}+
                                    </option>
                                @endfor
                            </select>
                        </div>
                        <!-- Available Only -->
                        <div class="col-md-2 d-flex align-items-center">
                            <div class="form-check mt-4">
                                <input class="form-check-input" type="checkbox" name="available_only" id="available_only"
                                    {{ request('available_only') ? 'checked' : '' }}>
                                <label class="form-check-label" for="available_only">
                                    <span class="text-success">Available Only</span>
                                </label>
                            </div>
                        </div>
                        <!-- Filter Button -->
                        <div class="col-md-1">
                            <button class="btn btn-primary w-100 mt-4" type="submit">
                                <i class="bi bi-funnel-fill"></i> Filter
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Translators Grid -->
        <div class="row">

            @if ($translators->isEmpty())
                <p class="text-center">No translators found.</p>
            @endif

            @foreach ($translators as $translator)
                <div class="col-md-4 mb-4">
                    <div class="card translator-card">
                        {{-- <img src="" class="card-img-top" alt="translator"> --}}
                        <img src="{{ asset($translator->profile) }}" alt="translator" class="img-fluid">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h5 class="card-title mb-0">
                                    @if ($translator->gender == 1)
                                        Mr.
                                    @else
                                        Miss.
                                    @endif
                                    {{ $translator->name }}
                                </h5>
                                @if (!empty($date))
                                    @if ($translator->is_available)
                                        <span class="badge bg-success">Available {{ $date }}</span>
                                    @else
                                        <span class="badge bg-danger">Unavailable {{ $date }}</span>
                                    @endif
                                @else
                                    @if ($translator->is_available)
                                        <span class="badge bg-success">Available Today</span>
                                    @else
                                        <span class="badge bg-danger">Unavailable Today</span>
                                    @endif
                                @endif
                            </div>
                            <div class="mb-2">
                                <h6 class="d-inline">Ratings:</h6>
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
                                <small class="text-muted">({{ $translator->rating }})</small>
                            </div>
                            <p class="card-text mb-2"><strong>Services:</strong></p>
                            @foreach ($translator->services as $service)
                            @endforeach
                            <div class="mb-2">
                                @foreach ($translator->services as $service)
                                    <span class="badge bg-secondary mb-1 me-1">
                                        {{ $service->language1 }} <i class="bi bi-arrow-left-right"></i>
                                        {{ $service->language2 }} - ฿{{ $service->price }}
                                    </span>
                                @endforeach
                            </div>
                            <div class="container text-center">
                                <div class="row">
                                    <div class="col-6">
                                        <a href="{{ route('translator.detail', ['id' => encrypt($translator->id)]) }}"
                                            class="btn btn-info w-100">Details</a>
                                    </div>
                                    <div class="col-6">
                                        <a href="{{ route('bookings.create', ['translator_id' => encrypt($translator->id), 'date' => request('date') ?? now()->toDateString()]) }}"
                                            class="btn btn-success w-100">
                                            Bookings
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
