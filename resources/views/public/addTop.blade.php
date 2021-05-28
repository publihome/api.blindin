<div class="col-lg-12 p-1 banner" id="contentAddTop"> 
    @foreach ($addsTop as $addTop)
        <a href="{{$addTop->url}} " class="">
            <img src="{{asset('storage').'/'. $addTop->image}}" class="img-add"/>
        </a>
    @endforeach

</div>

<script>
    const url_add = "http://localhost:8000/api/adds/top"
    let addsTop
    function getAdd(){
        $.get(url_add, function(response){
            let add = JSON.parse(response)
            console.log(add)
            addsTop = add
            // postAddTop()
        })
    }

    function postAddTop(){
        console.log(addsTop)
        const $content = document.querySelector('#contentAddTop');
            addsTop.map(add => {
                $content.innerHTML = `<a class="target" href="${add.url}">
                    <img src='../storage/${add.image}' class="img-principal"/>
                </a>`
            })

    }

    // getAdd()

</script>