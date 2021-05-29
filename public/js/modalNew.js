function getNewData(id){
    console.log(id)

    let newData = news.filter(x => x.id == id)
    console.log(newData)
    const  $modalTitle = document.querySelector("#modalTitle")
    const  $imagenNew = document.querySelector("#imagenNew")
    const  $modalNewText = document.querySelector("#modalNewText")
    newData.map(ND => {
    let newText = JSON.parse(ND.texto)
       
    $modalTitle.innerHTML = ND.titulo
    if (ND.img != "without image"){
        $imagenNew.innerHTML = `<img src="${ND.img}" alt="${ND.titulo}" class="img-new-post">`
    } 
    newText.map(NT => $modalNewText.innerHTML += `<p>${NT}</p> `)

    $('#Modalnew').modal('show')
       

    })

}