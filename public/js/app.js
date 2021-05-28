const uri = window.location.pathname
let end = uri.lastIndexOf("/")
let path = uri.slice(1,end).toLowerCase()
console.log(uri)
console.log(end)
console.log(path)

let link = document.querySelector(`#${path}`)
link.classList.add(`active-link-${path}`)


$('#btn-menu').click(function(e){
    $('.drop-menu').toggle('slow')
  })

  const printjs = (mensaje) => {
      console.log(mensaje)
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