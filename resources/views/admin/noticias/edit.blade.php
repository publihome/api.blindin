@include('templates.header')
@include('templates.navbarAdmin')
{{var_dump($new)}}
<div class="col-lg-10 mx-auto">
    @foreach ($new as $newData)
    <form action="{{url('/admin/noticias/'.$newData->id)}}" method="post" class="my-5" enctype ="multipart/form-data">
        @csrf
        {{method_field('PATCH')}}
        @include('forms.FormAddNew')
        
    </form>
        
    @endforeach

</div>