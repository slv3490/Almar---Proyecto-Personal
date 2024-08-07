window.addEventListener("DOMContentLoaded", function() {
    const checkbox = this.document.querySelector("#checkboxSpectator");
    if(checkbox) {
        showParagraph();
    }
})

function showParagraph() {
    const checkboxParagraph = document.querySelector("#checkboxSpectator");
    const paragraph = document.querySelector(".text-spectator");
    const emailLogin = document.querySelector(".emailLogin");
    const passwordLogin = document.querySelector(".passwordLogin");

    checkboxParagraph.addEventListener("input", function(e) {
        if(e.target.checked) {
            paragraph.classList.remove("display-none");
            emailLogin.value = "espectator@espectator.com";
            emailLogin.classList.add("disabled");
            passwordLogin.value = "espectator";
            passwordLogin.classList.add("disabled");
        } else {
            paragraph.classList.add("display-none");
            emailLogin.value = "";
            emailLogin.classList.remove("disabled");
            passwordLogin.value = "";
            passwordLogin.classList.remove("disabled"); 
        }
    })
}