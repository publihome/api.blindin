      <div  id="loaderPrincipal">
        <img src="{{asset('storage').'/images/icon.png'}}" alt="logo" class="loader-principal" />
      </div>

      <nav class="navbar-head">
        <div class="container">
            <img src="{{asset('storage').'/images/blindin_logo.png'}}" alt="logo" class="logo" />
          <div
            class="button-menu fas fa-bars" id="btn-menu"
          >
          </div>

          <div class="btns-region">
            <ul class="ul-top">
              <button
                class="navbar-li-region"
                id="oaxaca"
              >
                Oaxaca
              </button>
              <button
                class="navbar-li-region"
                id="nacional"                
              >
                México
              </button>
            </ul>
          </div>
        </div>
      </nav>

      <nav class="navbar">
        <div class="container">
          <ul class="navbar-ul">
            <div class="drop-menu">
              <a href="{{url('/')}}" class="navbar-li" id="recientes">
                     <span> <i class="far fa-clock"></i>Recientes</span>
              </a>
              <a href="{{url('/Salud')}}" class="navbar-li" id="salud">
                    <span><i class="fas fa-stethoscope"> </i> Salud</span>
              </a>
              <a href="{{url('/Economia')}}" class="navbar-li" id="economia">
                    <span><i class="fas fa-dollar-sign"> </i> Economia</span>
              </a>
              <a href="{{url('/Deportes')}}" class="navbar-li" id="deportes">
                    <span><i class="fas fa-basketball-ball"> </i> Deportes</span>
              </a>
              <a href="{{url('/Covid')}}" class="navbar-li" id="covid">
                    
                    <span><i class="fas fa-virus"></i> Covid</span>
              </a>
            </div>
          </ul>
        </div>
      </nav>


@include('public.addTop')

<div class="container mt-2 ">
  <hr>
  

  {{-- buscador --}}
  <nav class="navbar-info">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
            <ul class="p-0">
                <div class="search-container">
                    <input type="text" placeholder="Buscar" id="inputSearch" class="input-search"/>
                    <button class="btn-search" id="btnSearch" aria-label="search button"><i class="fas fa-search"></i></button>
                </div>
                <small class="text-warning bg-dark mt-2" id="textNoNews">
                </small>
            </ul>
    </div>
    
</nav>
  <h5>
    {{$sectionName}}
  </h5>
  
  <hr id={{$sectionName}}>

 
  
