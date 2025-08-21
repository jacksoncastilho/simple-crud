const form = document.querySelector("form")
let action = form.id.replace("-", "_")

form.addEventListener("submit", function (event){
    event.preventDefault()
    grecaptcha.ready(function() {
        grecaptcha.execute(window.env.PUBLIC_KEY_V3, {action: action}).then(function(token) {
            let recaptchaResponse = document.getElementById("g-recaptcha-response")
            recaptchaResponse.value = token

            const xhttp = new XMLHttpRequest()

            xhttp.onreadystatechange = function() {
                console.log(xhttp.responseText)
                /*if (this.readyState == 4 && this.status == 200) {
                    console.log(xhttp.responseText)
                }*/
            }

            xhttp.open("POST", "/bot-reCaptcha/app/v3/backend.php", true)
            xhttp.send(new FormData(form))
        })
    })
})
