let $news = document.querySelectorAll(".target")
console.log(news)

    $news.forEach(newSelected => {
        console.log(newSelected)
        newSelected.addEventListener('click', function(e){
            e.preventDefault()
            console.log(newSelected.getAttribute('id'))
            // let newSelectedId = newSelected.getAttribute('id')
            // let k = news.filter(ele => { return ele.id == newSelectedId})
               
        })
    });
