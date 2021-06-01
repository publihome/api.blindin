    @include('templates.header')
    @include('templates.navbarAdmin')
        @if(Session::has('mensaje'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">

    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        {{Session::get('mensaje')}}
    </div>
        @endif
        
        <div class="d-flex my-2">
            <button class="btn btn-success ml-auto" data-bs-toggle="modal" data-bs-target="#modelAdd">Agregar</button>
        </div>

        @if(count($errors)> 0)
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <P class="text-center">No rellenaste todos los campos!</P>
            </div>
        @endif
        

        <div class="list-group col-md-12 mx-auto">
            @foreach ($anuncios as $anuncio)
                <div class="list-group-item list-group-item-action d-flex flex-row justify-content-start" >
                    <div class="img">
                        <img src="{{ asset('storage').'/'.$anuncio->image }}" class="img-fluid mr-4 rounded" width="300" />
                    </div>
                    <div class="info mx-auto ">
                        <p class=".fs-2">Nombre de la publicidad: <span>{{$anuncio->nombreMarca}}</span></p>
                        <p class=".fs-2">Link: <span>{{$anuncio->url}}</span></p>
                        <p class=".fs-2">Posición: <span>{{$anuncio->position == "top" ? "Arriba" : "Abajo"}}</span></p>
                        <p class=".fs-2">Clicks: <span>{{$anuncio->clicks}}</span> </p>
                        <div class="d-flex ">
                        <a href="{{ url('admin/editPublicidad/'. $anuncio->id) }}" class="btn btn-warning mr-2">Editar</a>  
                            <form action="{{url('/admin/deletePublicidad/'. $anuncio->id)}}" method="POST">
                            @csrf
                            {{method_field('DELETE')}}
                                <input type="submit" class="btn btn-danger" value="Eliminar" onclick="return confirm('¿Quieres borrar?')">
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
        </div>
    </div>
        @if($anuncios->isEmpty())
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <h2 class="text-center">Aun no tienes anuncios, agrega uno</h2>
        </div>
        @endif


     <!-- Modal Agregar-->
     <div class="modal fade" id="modelAdd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Agreagar anuncio</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{url('/admin/addPublicidad')}}" method="post" enctype ="multipart/form-data">
            @csrf
            @include('forms.FormAddPublicidad',['mode' => 'add'])
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-success">Añadir</button>
            </form>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        </div>
        </div>
    </div>


{{-- @include('templates.footer') --}}