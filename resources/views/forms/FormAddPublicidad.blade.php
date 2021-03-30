<div class="form-group">
    <label for="nombre">Nombre de la marca</label>
    <input type="text" class="form-control" value="{{isset($data->nombreMarca) ?  $data->nombreMarca  : ''  }}" name="nombreMarca">
</div>

<div class="form-group">
    <label for="image">Imagen</label>
    @if(isset($data->image))
    <div class="img-fluid my-2 row justify-content-center">
        <img src="{{asset('storage') .'/'. $data->image}}" width=160 alt="{{$data->nombreMarca}}">
    </div>    
     @endif
    <input type="file" class="form-control" value="" name="image">
</div>

<div class="form-group">
    <label for="url">URL del sitio</label>
    <input type="text" class="form-control" value="{{isset($data->url) ?   $data->url : '' }}" name="url">
</div>

<div class="form-group">
    <label for="position">URL del sitio</label>
    <select name="position" id="" class="form-control">
        @if(isset($data->position))  
            <option value="{{$data->position}}" >
            @if($data->position == 'top') 
              Arriba 
              @else
               Abajo
               @endif
            </option>
            @if($data->position === "top")
            <option value="down">Abajo</option>
            @else
            <option value="top">Arriba</option>
            @endif
        @else
        <option value="">selecciona la posicion donde quieras que se vea el anuncio</option>
        <option value="top">Arriba</option>
        <option value="down">Abajo</option>
        @endif
    </select>
    
</div>

<!-- <button class="btn btn-success btn-large">Añadir</button> -->