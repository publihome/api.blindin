<div class="form-group">
    <label for="region" class="">Region</label>
    <select name="region" class="form-control @error('region') is-invalid @enderror">
        <option value="oaxaca" @isset($newData->region) {{$newData->region == "oaxaca" ? "selected" : ""}} @endisset>Oaxaca</option>
        <option value="nacional" @isset($newData->region) {{$newData->region == "nacional" ? "selected" : ""}} @endisset>Nacional</option>
    </select>
</div>
<div class="form-group">
    <label for="categoria">Categoria</label>
    <select name="categoria" class="form-control @error('categoria') is-invalid @enderror">
        <option value="Recientes">Recientes</option>
        <option value="Deportes">Deportes</option>
        <option value="Salud">Salud</option>
        <option value="Economia">Economia</option>
        <option value="Covid">Covid</option>
        <option value="Deportes">Deportes</option>
        <option value="nacional">Nacional</option>
    </select>
</div>
<div class="form-group">
    <label for="titulo">Titulo</label>
    <input type="text" class="form-control @error('titulo') is-invalid @enderror" name="titulo" value="{{isset($newData->titulo) ? $newData->titulo : ''}}">
    @error('titulo') <small class="text-danger">{{ $message }}</small> @enderror
</div>

<div class="form-group">
    <label for="resumen">Imagen</label>
    <input type="file" class="form-control @error('img') is-invalid @enderror" name="img">
    @error('img') <small class="text-danger">{{ $message }}</small> @enderror
    @if(isset($newData->img)) 
    <img src="{{asset('storage').'/'.$newData->img}}" alt="" width="200" height="200">
    @endif
</div>

<div class="form-group">
    <label for="resumen">Resumen</label>
    <textarea name="resumen" class="form-control @error('resumen') is-invalid @enderror" cols="30" rows="5">     
        @isset($newData->resumen) {{$newData->resumen}} @endisset
    </textarea>
    @error('resumen') <small class="text-danger">{{ $message }}</small> @enderror
</div>

<div class="form-group">
    <label for="noticia">Noticia</label>
    <textarea name="texto" cols="30" rows="15" class="form-control @error('texto') is-invalid @enderror">
        @isset($newData->texto) {{$newData->texto}} @endisset
    </textarea>
    @error('texto') <small class="text-danger">{{ $message }}</small> @enderror

</div>

<button class="btn btn-success ml-auto" type="submit">Guardar</button>