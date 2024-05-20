<header id="header" class="fixed-top">
    <div class="container d-flex align-items-center justify-content-between">
        <!-- <a href="index.html" class="logo"><img src="assets/img/logo.png" alt="" class="img-fluid"></a> -->
        <!-- Uncomment below if you prefer to use text as a logo -->
        <h1 class="logo"><a href="{{ route('welcome') }}">{{ $title->title }}</a></h1>

        <nav id="navbar" class="navbar">
            <ul>
                <li><a class="nav-link scrollto" href="{{ route('welcome') }}">Home</a></li>
                <li><a class="nav-link scrollto" href="#services">Layanan</a></li>
                <li><a class="nav-link scrollto" href="#team">Kegiatan</a></li>
                <li><a class="nav-link scrollto " href="{{ route('balita.show') }}">Balita</a></li>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav>

    </div>
</header>
