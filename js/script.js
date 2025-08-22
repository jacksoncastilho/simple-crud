const form = document.querySelector("form")
const message = document.querySelector("#message")

let action = form.id.replace("-", "_")

function formValidation(token) {
    const xhttp = new XMLHttpRequest()
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            let serverReturn = JSON.parse(xhttp.responseText)
            message.textContent = serverReturn.message

            if(serverReturn.success) {
                setTimeout(() => {
                    switch (form.id) {
                        case "signup-form":
                            window.location.href = "/simple-crud/src/login.php"
                            break
                        case "reset-form":
                            window.location.href = "/simple-crud/index.php"
                            break
                    }
                }, 2000)
            } else {
                setTimeout(() => location.reload(), 2000)
            }
        }
    }

    xhttp.open("POST", "/simple-crud/src/backend.php?form="+form.id, true)
    xhttp.setRequestHeader('gr-response', token);
    xhttp.send(new FormData(form))    
}

form.addEventListener("submit", function (event){
    event.preventDefault()
    
    grecaptcha.ready(function() {
        grecaptcha.execute(window.env.PUBLIC_KEY_V3, {action: action}).then(function(token) {

            formValidation(token)
        })
    })
})