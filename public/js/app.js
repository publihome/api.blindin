let uri = window.location.pathname
let path = uri.slice(1,uri.length).toLowerCase()
const url_base = "https://blindin.mx/api"
let link = document.getElementById(path)
link.classList.add(`active-link-${path}`)
const $btnSearch = document.getElementById("btnSearch")
let $inputSearch = document.getElementById("inputSearch")
let page = 1

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
    });
}

window.addEventListener('scroll', function(){
    if ((window.innerHeight + window.scrollY) == (document.body.offsetHeight)) {
    // if((document.innerHeight + window.scrollY) == document.body.offsetHeight){
        getData()
        page= page + 1
        console.log(window.scrollY + window.innerHeight)
        console.log(document.body.offsetHeight)
    }
    
})

