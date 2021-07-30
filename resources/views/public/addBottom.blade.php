<div class="p-1 add-bottom" id="contentAddBottom"> 
    @foreach ($addsBottom as $addBottom)
        <a href="{{$addBottom->url}}" class="">
            <img src="{{asset('storage').'/'. $addBottom->image}}" class="img-add" alt="publicidad"/>
        </a>
    @endforeach

</div>

<script>
    // const url_add = "http://localhost:8000/api/adds/top"
    // let addsTop
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