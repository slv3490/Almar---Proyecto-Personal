document.addEventListener("DOMContentLoaded", function() {
    iniciarApp();
})

function iniciarApp() {
    const optionsUser = document.querySelector(".options-user");
    const user = document.querySelector(".user");
    
    if(user) {
        user.addEventListener("click", function(event) {
            if(optionsUser.classList.contains("show-options")) {
                optionsUser.classList.remove("show-options");
                optionsUser.classList.add("hidden-options");
            } else {
                optionsUser.classList.remove("hidden-options");
                optionsUser.classList.add("show-options");
            }
    
            window.addEventListener("click", function(e) {
                if(!user.contains(e.target)) {
                    optionsUser.classList.remove("show-options");
                    optionsUser.classList.add("hidden-options");
                }
            });
        });
    }
    
}