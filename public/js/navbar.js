
const $oaxacabtn = document.getElementById('oaxaca')
const $mexicobtn = document.getElementById('nacional')
let region;
let news

$('#btn-menu').click(function(e){
    $('.drop-menu').toggle('slow')
  })

function setRegion(reg){
    document.getElementById(reg).classList.add('btn-active-region')
    console.log(reg)
    console.log(region)
    if(reg != region ){
    document.querySelector('#content').innerHTML = "";       
    }
    console.log(news)
    region = reg   
    getData()
}

$oaxacabtn.addEventListener('click', () =>{
    $oaxacabtn.classList.add('btn-active-region')
    $mexicobtn.classList.remove('btn-active-region')
    setRegion('oaxaca')   
})

$mexicobtn.addEventListener('click', () => {
    $mexicobtn.classList.add('btn-active-region')
    $oaxacabtn.classList.remove('btn-active-region')
    setRegion('nacional')
})

setRegion('oaxaca')





