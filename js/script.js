const form = document.querySelector("form")

form.addEventListener("submit", function (event){
    const xhttp = new XMLHttpRequest()

    xhttp.onreadystatechange = function() {
        console.log(xhttp.responseText)
    }

    xhttp.open("POST", "/simple-crud/src/backend.php?form="+form.id, true)
    xhttp.send(new FormData(form))
})
