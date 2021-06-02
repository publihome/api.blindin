let uri = window.location.pathname
let path = uri.slice(1,uri.length).toLowerCase()
const url_base = "https://blindin.mx/api"
let link = document.getElementById(path)
link.classList.add(`active-link-${path}`)
const $btnSearch = document.getElementById("btnSearch")
let $inputSearch = document.getElementById("inputSearch")
const metaDescription = document.querySelector('meta[name="description"]')
let page = 1

let urls = {
    recientes: 'recent',
    salud: 'health',
    economia: 'economy',
    deportes: 'Espacio informatio de noticias sobre deportes',
    covid: 'noticias de covid en oaxaca'
}

let description = {
    recientes: 'noticias de hoy, espacio informativo de noticias recientes',
    salud: 'Espacio informatio de noticias sobre salud',
    economia: 'Espacio informatio de noticias sobre economia de oaxaca',
    deportes: 'sports',
    covid: 'covid'
}

function postData(){
    const $content = document.querySelector('#content');
    news.map(n => {
        $content.innerHTML += `<div class="col-lg-3 col-md-4 col-sm-6 mb-2 p-1"  >
            <div class="target" id="${n.id}" onclick='getNewData(${[n.id]})' >
                <img src=${n.img == 'without image' ? '../../storage/images/no-disponible.png' : n.img} alt='${n.titulo}' class="img-principal"/>
                <div class="text-overlay">
                </div>
                    <p class="title">${n.titulo}</p>
            </div>
        </div>`
    })    
}

function getData(){
    $.get(`${url_base}/${urls[path]}/${region}?page=${page}`, function(response){
        let data = JSON.parse(response) 
        console.log(data)
        news = data.data
        postData()
        seo()

    });
}

window.addEventListener('scroll', function(){
    if ((window.innerHeight + window.scrollY) == (document.body.offsetHeight)) {
        getData()
        page= page + 1
        console.log(window.scrollY + window.innerHeight)
        console.log(document.body.offsetHeight)
    }
    
})

function seo(){
    window.title = `BLINDIN | ${path.toUpperCase()}`
    metaDescription.setAttribute('content', description[path])
    
}

