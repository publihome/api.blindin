@include('templates.header')
@include('templates.navbarAdmin')

<div class="col-lg-10 mx-auto">
    <form action="{{url('/admin/noticias/guardar')}}" method="post">
        @csrf
        <div class="form-group">
            <label for="region" class="">Region</label>
            <select name="region" class="form-control">
                <option value="oaxaca">Oaxaca</option>
                <option value="nacional">Nacional</option>
            </select>
        </div>
        <div class="form-group">
            <label for="categoria">Categoria</label>
            <select name="categoria" class="form-control">
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
            <input type="text" class="form-control" name="titulo">
        </div>

        <div class="form-group">
            <label for="resumen">Imagen</label>
            <input type="file" class="form-control" name="img">
        </div>

        <div class="form-group">
            <label for="resumen">Resumen</label>
            <textarea name="resumen" class="form-control" cols="30" rows="5">
                
            </textarea>
        </div>
        
        <div class="form-group">
            <label for="noticia">Noticia</label>
            <textarea name="texto" cols="30" rows="15" class="form-control">
                
            </textarea>
        </div>

        <button class="btn btn-success ml-auto" type="submit">Agregar</button>
    </form>

</div>