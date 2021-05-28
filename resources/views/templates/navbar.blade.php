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
              <li class="navbar-li" id="recientes">
                  <a href="{{url('/')}}">
                    <i class="far fa-clock"></i>Recientes
                  </a>
              </li>
              <li class="navbar-li" id="salud">
                  <a href="{{url('/Salud')}}">
                    <i class="fas fa-stethoscope"> </i>
                    Salud
                  </a>
              </li>
              <li class="navbar-li" id="economia">
                  <a href="{{url('/Economia')}}">
                    <i class="fas fa-dollar-sign"> </i>
                    Economia
                  </a>
              </li>
              <li class="navbar-li" id="deportes">
                  <a href="{{url('/Deportes')}}">
                    <i class="fas fa-basketball-ball"> </i>
                    Deportes
                  </a>
              </li>
              <li class="navbar-li" id="covid">
                  <a href="{{url('/Covid')}}">
                    <i class="fas fa-virus"></i>
                    Covid
                  </a>
              </li>
            </div>
          </ul>
        </div>
      </nav>

@include('public.addTop')

<div class="container mt-2">
  <hr>

  {{-- buscador --}}
  <nav class="navbar-info">
    <div class="container-lg container-md">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
            <ul>
                <div class="search-container">
                    <input type="text" placeholder="Buscar" id="inputSearch" class="input-search"/>
                    <button class="btn-search" id="btnSearch"><i class="fas fa-search"></i></button>
                </div>
            </ul>
        </div>
    </div>
    
</nav>
  <h5>
    {{$sectionName}}
  </h5>
  
  <hr id={{$sectionName}}>
  
