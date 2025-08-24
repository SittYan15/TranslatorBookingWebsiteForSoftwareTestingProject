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
                            {{ $service->language1 }} <-> {{ $service->language2 }}
                                (฿{{ $service->price }})
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
                <input type="text" class="form-control" name="location" id="location" placeholder="Enter location"
                    required>
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
            <button type="button" class="btn btn-success w-100" id="openConfirmModal">
                <i class="bi bi-calendar-plus"></i> Confirm Booking
            </button>
        </form>
    </div>

    <!-- Confirmation Modal -->
    <div class="modal fade" id="confirmBookingModal" tabindex="-1" aria-labelledby="confirmBookingLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="confirmBookingLabel"><i class="bi bi-calendar-check"></i> Confirm Booking
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-2">
                        <strong>Date:</strong> <span id="modalBookingDate"></span>
                    </div>
                    <div class="mb-2">
                        <strong>Time:</strong> <span id="modalBookingTime"></span>
                    </div>
                    <div class="mb-2">
                        <strong>Location:</strong> <span id="modalBookingLocation"></span>
                    </div>
                    <div class="mb-2">
                        <strong>Duration:</strong> <span id="modalBookingDuration"></span>
                    </div>
                    <div class="mb-2">
                        <strong>Price:</strong> ฿<span id="modalBookingPrice"></span>
                    </div>
                    <hr>
                    Are you sure you want to confirm this booking?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-success" id="modalConfirmBtn">Yes, Confirm</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modal = new bootstrap.Modal(document.getElementById('confirmBookingModal'));
            const openBtn = document.getElementById('openConfirmModal');
            const confirmBtn = document.getElementById('modalConfirmBtn');
            const form = document.querySelector('form');

            openBtn.addEventListener('click', function() {
                // run validation and show messages if invalid
                if (form.reportValidity()) {

                    const getSelectedServicePrice = () => {
                        const serviceSelect = document.getElementById('service_id');
                        const selectedOption = serviceSelect.options[serviceSelect.selectedIndex];
                        const priceMatch = selectedOption.text.match(/฿\d+(\.\d{1,2})?/);
                        return priceMatch ? parseFloat(priceMatch[0].replace('฿', '')) : 0;
                    };
                    // Fill modal info
                    document.getElementById('modalBookingDate').textContent = document.getElementById(
                        'booking_date').value;
                    document.getElementById('modalBookingTime').textContent = document.getElementById(
                        'booking_start_time').value;
                    document.getElementById('modalBookingLocation').textContent = document.getElementById(
                        'location').value;
                    const hrs = parseInt(document.getElementById('duration_hrs').value) || 0;
                    const mins = parseInt(document.getElementById('duration_mins').value) || 0;
                    document.getElementById('modalBookingDuration').textContent = `${hrs} hrs ${mins} mins`;

                    // Calculate price
                    const pricePerHour = getSelectedServicePrice();
                    const totalPrice = (hrs + mins / 60) * pricePerHour;
                    document.getElementById('modalBookingPrice').textContent = totalPrice.toFixed(2);

                    modal.show();
                }
            });

            confirmBtn.addEventListener('click', function() {
                form.submit();
            });
        });
    </script>

@endsection
