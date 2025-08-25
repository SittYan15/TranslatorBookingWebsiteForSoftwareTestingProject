<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('#') }}">StudiGo</a>
        <a class="navbar-brand" href="{{ url('search') }}">Translator Search</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link bg-danger text-white" href="{{ route('logout') }}">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>
