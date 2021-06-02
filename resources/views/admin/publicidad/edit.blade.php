@include('templates.header')
@include('templates.navbar')
<div class="col-md-6 col-lg-6 mx-auto">
@foreach($anuncio as $data)
<form action="{{url('admin/updatePublicidad/'.$data->id)}}" method="post" enctype="multipart/form-data">
    @csrf
    {{method_field('PATCH')}}
    @include('forms.FormAddPublicidad')
    <input type="submit" class="btn btn-success" value="Actualizar">
</form>
</div>
@endforeach
@include('templates.footer')