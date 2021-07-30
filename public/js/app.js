let uri = window.location.pathname
let path = uri.slice(1,uri.length).toLowerCase()
const url_base = "https://blindin.mx/api"
let link = document.getElementById(path)
link.classList.add(`active-link-${path}`)
const $btnSearch = document.getElementById("btnSearch")
let $inputSearch = document.getElementById("inputSearch")
let loader = document.querySelector(".loader")
const metaDescription = document.querySelector('meta[name="description"]')
let loaderPrincipal = document.getElementById("loaderPrincipal")

let page = 1

let urls = {
    recientes: 'recent',
    salud: 'health',
    economia: 'economy',
    deportes: 'sports',
    covid: 'covid'
}

let description = {
    recientes: 'noticias de hoy, espacio informativo de noticias recientes',
    salud: 'Espacio informatio de noticias sobre salud',
    economia: 'Espacio informatio de noticias sobre economia de oaxaca',
    deportes: 'Espacio informatio de noticias sobre deportes',
    covid: 'noticias de covid en oaxaca'
}



function postData(){
    const $content = document.querySelector('#content');
    news.map(n => {
        $content.innerHTML += `
            <div class="target" id="${n.id}" onclick='getDataById(${[n.id]})' >
                <img src=${n.img == 'without image' ? '../../storage/images/no-disponible.png' : n.img} alt='${n.titulo}' class="img-principal"/>
                <div class="text-overlay">
                </div>
                    <p class="title">${n.titulo}</p>
            </div>
        `
    })
        loader.innerHTML =""    
}

function getData(){
    fetch(`${url_base}/${urls[path]}/${region}?page=${page}`)
    .then(response => response.json())
    .then(data => {
        console.log(data)
        news = data.data
        postData()
        seo()
        page= page + 1
    })
    .catch(err => {
        window.location.reload
    })
}



function getDataById(idNew){
    $.get(`${url_base}/new/${idNew}`, function(response){
        console.log(response)  
        let newFromId = response
        openModal(newFromId)
        seo(newFromId[0]['titulo'])
    });
}

window.addEventListener('scroll', function(){
    if ((window.innerHeight + window.scrollY) == (document.body.offsetHeight)) {
            loader.innerHTML = '<img src="../../storage/images/icon.png" alt="" class="img-loader">'
            getData()
        console.log(window.scrollY + window.innerHeight)
        console.log(document.body.offsetHeight)
    }
    
})

function seo(title = ""){
    let metas = document.getElementsByName('description')
    window.title.innerHTML = `BLINDIN | ${path.toUpperCase()}`
    metas[0].setAttribute('content', description[path])
    if(title != ""){
        window.title.innerHTML = `BLINDIN | ${title}`
    }
    
}

window.addEventListener('load', function(e) {
loaderPrincipal.innerHTML = ""
});

