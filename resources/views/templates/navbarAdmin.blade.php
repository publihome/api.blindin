<nav class="navbar navbar-expand-lg navbar-primary bg-light text-primary">
    <div class="container">
            <a class="navbar-brand" href="#"><img src="{{asset('storage').'/images/blindin_logo.png'}}" class="logo" alt="logo"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav ml-auto">
            {{-- <a class="nav-link {{ Request::is('admin') ? 'active' : ""}}" href="/admin"><i class="fas fa-chart-line"></i> Dashboard</a> --}}
            <a class="nav-link {{ Request::is('admin/publicidad') ? 'active' : ""}}" href="/admin/publicidad"><i class="fas fa-columns"></i> Publicidad</a>
            <a class="nav-link {{ Request::is('admin/noticias') ? 'active' : ""}}" href="/admin/noticias"><i class="far fa-newspaper"></i> Noticias</a>
            <a class="nav-link " href="{{url('/logout')}}" ><i class="fas fa-sign-out-alt"></i> Salir</a>
        </div>
        </div>
    </div>
  </nav>

  <div class="container">

    @if(Session::has('mensaje'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">

        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            {{Session::get('mensaje')}}
        </div>
    @endif
 