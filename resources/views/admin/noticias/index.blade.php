@include('templates.header')
@include('templates.navbarAdmin')
{{-- @if(Session::has('mensaje'))
<div class="alert alert-success alert-dismissible fade show" role="alert">

<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    {{Session::get('mensaje')}}
</div>
    @endif --}}
<div class="d-flex my-2">
    <a class="btn btn-success ml-auto" href="{{url('/admin/noticias/create')}}">Agregar</a>
</div>

<div class="row">
    @foreach ($noticias as $noticia)
        <div class="col-lg-3 col-md-4 col-sm-2">
            <div class="target" id={{$noticia->id}} onclick='getNewData({{$noticia->id}})' >
                <img src={{$noticia->img == 'without image' ? '../../storage/images/no-disponible.png' : asset('storage').'/'.$noticia->img}} alt='{{$noticia->titulo}}' class="img-principal"/>
                <div class="text-overlay"></div>
                <div class="buttons">
                    <div class="d-flex justify-content-center">
                        <a href="{{url('/admin/noticias/'.$noticia->id.'/edit')}}" class="btn btn-warning mr-1 text-white"><i class="far fa-edit"></i></a>
                        <form action="{{url('/admin/noticias/'.$noticia->id)}}" method="post">
                            @csrf
                            {{method_field('DELETE')}}
                            <button class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
                        </form>
                    </div>
                </div>
                <p class="title">{{$noticia->titulo}}</p>
                    
            </div>
        </div>
        
    @endforeach

</div>