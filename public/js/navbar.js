const $oaxacabtn = document.getElementById('oaxaca')
const $mexicobtn = document.getElementById('nacional')
let region;
let news

console.log(localStorage.getItem('region'))

$('#btn-menu').click(function(e){
    $('.drop-menu').toggle('slow')
  })

function setRegion(reg = ""){
    if(reg != ""){
        if(reg != region ){
            document.querySelector('#content').innerHTML = "";       
            }
        region = reg   
        localStorage.setItem('region',region)     
    }
    if(localStorage.getItem('region') == "" || localStorage.getItem('region') == null){
        localStorage.setItem('region', 'oaxaca')
        region = 'oaxaca'
        $oaxacabtn.classList.add('btn-active-region')
    }else{
        region = localStorage.getItem('region')
        document.getElementById(region).classList.add('btn-active-region')       
    }
      
    getData()
}

$oaxacabtn.addEventListener('click', () =>{
    $oaxacabtn.classList.add('btn-active-region')
    $mexicobtn.classList.remove('btn-active-region')
    setRegion('oaxaca')
    page=1   
})

$mexicobtn.addEventListener('click', () => {
    $mexicobtn.classList.add('btn-active-region')
    $oaxacabtn.classList.remove('btn-active-region')
    setRegion('nacional')
    page=1
})

function getSearchNews(word){
    $.get(`${url_base}/search/${word}`, function(response){
        let data = JSON.parse(response)
        console.log(data)
        if(data.data == ""){
            document.querySelector('#textNoNews').innerHTML = 'No se encontraron noticias'
            return 0
        }
        document.querySelector('#textNoNews').innerHTML = ''
        document.querySelector('#content').innerHTML = "";       
        news = data.data
        postData()
    })

}

document.querySelector('#inputSearch').addEventListener('click', function(e){
    document.querySelector('#textNoNews').innerHTML = ''

})

$inputSearch.addEventListener('keypress',(e) => {
    if(e.key == "Enter"){
        e.target.value != "" ? getSearchNews(e.target.value) : ""
    }
})


window.btnSearch.addEventListener('click', function(e){
    e.preventDefault()
    $input = document.getElementById('inputSearch')
    if($input.value != ""){
        getSearchNews($input.value)
    }
})

setRegion()





