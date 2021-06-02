<!-- Modal -->
<div class="modal fade" id="Modalnew" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl ">
      <div class="modal-content">
        <div class="modal-header">
            <img src="{{url('storage').'/images/blindin_logo.png'}}" alt="logo" class="logo">
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="modalBody">
          <h1 class="title-new" id="modalTitle"></h1>
          <div class="cont-img-new" id="imagenNew">
            
          <hr class="my-2">
          </div>
          <div class="new-content" id="modalNewText">

          </div>
          @include('public.addBottom')
        </div>
      </div>
    </div>
  </div>