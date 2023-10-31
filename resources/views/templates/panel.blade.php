<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar" style="min-height: 100vh;">
    <div class="position-sticky">
        <!-- Logo and Brand Name -->
        <div class="text-center py-3">
            {{--imagen esta en public images user.webp--}}
            <img src="{{ asset('images/user.webp') }}" alt="Logo"
                 class="img-fluid logo">
            <h5 class="mt-2 brand-name"><a href="http://whitestudio.team/" class="text-decoration-none">
                    Estudiante X</a></h5>
        </div>

        <!-- Menu Links -->
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" href="/">
                    <i class="bi bi-house-door"></i> Inicio
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/create">
                    <i class="bi bi-plus-circle"></i> Crear Nueva Tarea
                </a>
            </li>

            {{--<li class="nav-item">
                <a class="nav-link" href="#logout">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </a>
            </li>--}}
        </ul>
    </div>
</nav>


