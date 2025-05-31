{{-- Navbar Bootstrap 5 extraída de marcas/modelos --}}
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Celulares</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('modelos.index') ? 'active' : '' }}" href="{{ route('modelos.index') }}">Modelos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('marcas.index') ? 'active' : '' }}" href="{{ route('marcas.index') }}">Marcas</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
