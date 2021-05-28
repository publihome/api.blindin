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
                id="Oaxaca"
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
              <li class="navbar-li" id="salud" @if(url('/Salud')) class="active-link-salud" @endif>
                  <a href="{{url('/Salud/oaxaca')}}">
                    <i class="fas fa-stethoscope"> </i>
                    Salud
                  </a>
              </li>
              <li class="navbar-li" id="economia">
                  <a href="{{url('/Economia/oaxaca')}}">
                    <i class="fas fa-dollar-sign"> </i>
                    Economia
                  </a>
              </li>
              <li class="navbar-li" id="deportes">
                  <a href="{{url('/Deportes/oaxaca')}}">
                    <i class="fas fa-basketball-ball"> </i>
                    Deportes
                  </a>
              </li>
              <li class="navbar-li" id="covid">
                  <a href="{{url('/Covid/oaxaca')}}">
                    <i class="fas fa-virus"></i>
                    Covid
                  </a>
              </li>
            </div>
          </ul>
        </div>
      </nav>
<script>
  $('#btn-menu').click(function(e){
    console.log("hola")
    // e.preventDefault()
    $('.drop-menu').toggle('slow')
  })
</script>
@include('public.addTop')

<div class="container mt-2">
  <h5>
    {{$sectionName}}
  </h5>
  
  <hr id={{$sectionName}}/>
  
