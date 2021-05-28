let uri = window.location.pathname
let end = uri.lastIndexOf("/")
let region
let path = uri.slice(1,end).toLowerCase()
const url_base = "http://localhost:8000/api"
let link = document.querySelector(`#${path}`)
link.classList.add(`active-link-${path}`)
let news

let urls = {
    recientes: 'recent',
    salud: 'health',
    economia: 'economy',
    deportes: 'sports',
    covid: 'covid'
}
  
function postData(){
    const $content = document.querySelector('#content');
    news.map(n => {
        $content.innerHTML += `<div class="col-lg-3 col-md-4 col-sm-6 mb-2 p-1" >
            <div class="target">
                <img src=${n.img == 'without image' ? '../../storage/images/no-disponible.png' : n.img} alt=${n.titulo} class="img-principal"/>
                <div class="text-overlay">
                </div>
                    <p class="title">${n.titulo}</p>
            </div>
        </div>`
    })
}

function getData(){
    $.get(`${url_base}/${urls[path]}/oaxaca`, function(response){
        let data = JSON.parse(response) 
        console.log(data)
        news = data.data
        postData()
    })
}

getData()


$('#btn-menu').click(function(e){
    $('.drop-menu').toggle('slow')
  })