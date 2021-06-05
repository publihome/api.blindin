@include('templates.header')
@include('templates.navbarAdmin')

<div class="col-lg-10 mx-auto">
    <form action="{{url('/admin/noticias')}}" method="post" class="my-5" enctype ="multipart/form-data">
        @csrf
        @include('forms.FormAddNew')
        
    </form>

</div>