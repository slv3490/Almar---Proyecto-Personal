document.addEventListener("DOMContentLoaded", function() {
    iniciarApp();
})

function iniciarApp() {
    mostrarCards();
}

function mostrarCards() {
    const cards = document.querySelectorAll(".cards-articulos");
    cards.forEach(card => {
        card.addEventListener("mouseenter", function(e) {
            const titulo = e.target.children[1].children[0];
            titulo.classList.remove("d-none");
            titulo.classList.add("titulo-anim");

            const descripcion = e.target.children[1].children[1];
            descripcion.classList.add("txt-anim");
            descripcion.classList.remove("d-none")

            const fondo = e.target.children[2];
            fondo.classList.add("fondo-card");

            const imagen = e.target.children[0];
            imagen.classList.add("scale");

            
            const backgroundActive = e.target.children[2];
            backgroundActive.classList.add("background-active");
        })

        card.addEventListener("mouseleave", function(e) {
            const titulo = e.target.children[1].children[0];
            titulo.classList.remove("titulo-anim");
            titulo.classList.add("d-none");

            const descripcion = e.target.children[1].children[1];
            descripcion.classList.remove("txt-anim");
            descripcion.classList.add("d-none")

            const fondo = e.target.parentElement.parentElement.parentElement;
            fondo.classList.remove("fondo-card");

            const imagen = e.target.children[0];
            imagen.classList.remove("scale");

            const backgroundActive = e.target.children[2];
            backgroundActive.classList.remove("background-active");
        })
    })
}