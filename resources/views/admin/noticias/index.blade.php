@include('templates.header')
@include('templates.navbarAdmin')
@if(Session::has('mensaje'))
<div class="alert alert-success alert-dismissible fade show" role="alert">

<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    {{Session::get('mensaje')}}
</div>
    @endif
<div class="d-flex my-2">
    <a class="btn btn-success ml-auto" href="/admin/noticias/agregar">Agregar</a>
</div>
