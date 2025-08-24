<!-- filepath: /Applications/XAMPP/xamppfiles/htdocs/ST_TranslatorWebsite/resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Translator Website')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>

<body
    style="background-image: url('{{ asset('public/img/website/translator_detail_bg.jpeg') }}'); background-size: cover; background-position: center; background-attachment: fixed;">

    @if (session('success'))
        <div class="position-fixed top-0 end-0 p-3" style="z-index: 1055;">
            <div class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive"
                aria-atomic="true" id="mainToast">
                <div class="toast-header bg-success text-white">
                    <i class="bi bi-check-circle-fill text-white me-2 fs-5"></i>
                    <strong class="me-auto">Success</strong>
                    <small class="text-light">Just now</small>
                    <button type="button" class="btn-close btn-close-white ms-2" data-bs-dismiss="toast"
                        aria-label="Close"></button>
                </div>
                <div class="toast-body text-success fw-semibold text-white">
                    {{ session('success') }}
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var toastEl = document.getElementById('mainToast');
                if (toastEl) {
                    var toast = new bootstrap.Toast(toastEl);
                    toast.show();
                }
            });
        </script>
    @endif

    @if (session('error'))
        <div class="position-fixed top-0 end-0 p-3" style="z-index: 1055;">
            <div class="toast align-items-center text-bg-danger border-0" role="alert" aria-live="assertive"
                aria-atomic="true" id="mainToast">
                <div class="toast-header bg-danger text-white">
                    <i class="bi bi-x-circle-fill text-white me-2 fs-5"></i>
                    <strong class="me-auto">Error</strong>
                    <small class="text-light">Just now</small>
                    <button type="button" class="btn-close btn-close-white ms-2" data-bs-dismiss="toast"
                        aria-label="Close"></button>
                </div>
                <div class="toast-body text-danger fw-semibold text-white">
                    {{ session('error') }}
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var toastEl = document.getElementById('mainToast');
                if (toastEl) {
                    var toast = new bootstrap.Toast(toastEl);
                    toast.show();
                }
            });
        </script>
    @endif

    @include('partials.menu')
    <main class="py-4">
        @yield('content')
    </main>
    @include('partials.footer')


</body>

</html>
