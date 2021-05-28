@include('templates.header')
@include('templates.navbar')

<div class="row" id="content">

</div>

<script>
    const url_base = "http://localhost:8000/api/recent/oaxaca"
    let news
    function getData(){
        $.get(url_base, function(response){
            let data = JSON.parse(response) 
            console.log(data)
            news = data.data
            postData()
        })
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
    // getData()

    
    
</script>
@include('templates.footer')