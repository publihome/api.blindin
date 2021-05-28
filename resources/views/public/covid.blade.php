@include('templates.header')
@include('templates.navbar')

<div class="row" id="content">

</div>

<script>
    const url_base = "http://localhost:8000/api/covid/oaxaca"
    let news
    function getData(){
        $.get(url_base, function(response){
            let data = JSON.parse(response) 
            console.log(data)
            news = data.data
            postData()
        })
    }

    getData()

    
    
</script>
@include('templates.footer')