document.addEventListener("DOMContentLoaded", function() {
    validateCategoryOptions();
    // showCategoriesEdit();
    categoriesQuery();
    categoriesList();
})


//Mostrar las categorias disponibles a elegir
async function categoriesQuery() {
    try {
        const url = "/api/categories-query";
        const response = await fetch(url);
        const result = await response.json();

        categoriesOptions(result);
    } catch (error) {
        console.log(error)
    }
}

let categoriesArray = [];
let selection = [];
let currentSelection = [];

function categoriesOptions(categories) {
    const selectionCategories = document.querySelector("#seleccionar-categorias");

    const inputHidden = document.querySelector("#category_lesson");

    if(selectionCategories) {
        categories[0].forEach(e => {
            const options = document.createElement("OPTION");
            options.value = e.id;
            options.textContent = e.name

            categoriesArray = [...categoriesArray, e];

            selectionCategories.appendChild(options);
        });
    }

    if(inputHidden) {

        if(inputHidden.value !== "") {
            const valuesInputEdit = inputHidden.value.slice(0, -1);
            
            valuesInputEdit.split(",").forEach(function(e) {
                const categoriesFilter = categoriesArray.filter(item => item.id == e)
                
                selection = [...selection, categoriesFilter[0]];
            })
    
            const categoriesList = document.querySelector("#categoriesList");
            while(categoriesList.firstChild) {
                categoriesList.removeChild(categoriesList.firstChild)
            }
            selection.forEach(function(e) {
                const listHTML = document.createElement("LI");
                listHTML.textContent = e.name;
                listHTML.id = e.id;
                listHTML.classList.add("idListCategories");
                
                categoriesList.appendChild(listHTML);
            })
            removeItemList();
        }
    }

}

function validateCategoryOptions() {
    const createCourseButton = document.querySelector("#createCourse");
    if(createCourseButton) {
        createCourseButton.addEventListener("click", function(e) {
            if(selection.length === 0) {
                e.preventDefault();
                const errorCategoryOption = document.querySelector(".error-category-options");
                errorCategoryOption.textContent = "Debes elegir almenos una categoria";
            }
        })
    }
}

//Listar las categorias que el usuario haya elegido
function categoriesList() {
    const selectionCategories = document.querySelector("#seleccionar-categorias");
    const buttonAdd = document.querySelector("#buttonAdd");

    if(selectionCategories && buttonAdd) {
        selectionCategories.addEventListener("change", function(e) {
            currentSelection = [];
            const dataCategory = {
                id: parseInt(e.target.value),
                name: e.target.selectedOptions[0].textContent
            }
            currentSelection = [...currentSelection, dataCategory]
        })
        
        buttonAdd.addEventListener("click", function() {
            let alreadyExist = false;
            selection.forEach(item => {
                if(item.id == currentSelection[0].id) {
                    alreadyExist = true;
                    return;
                }
            })
            if(alreadyExist) return;
            
            selection = [...selection, currentSelection[0]];
            updateValuesToHiddenInput();
            
            const categoriesList = document.querySelector("#categoriesList");
            while(categoriesList.firstChild) {
                categoriesList.removeChild(categoriesList.firstChild)
            }
            selection.forEach(function(e) {
                const listHTML = document.createElement("LI");
                listHTML.textContent = e.name;
                listHTML.id = e.id;
                listHTML.classList.add("idListCategories");
                
                categoriesList.appendChild(listHTML);
            })
            removeItemList();
        })
    }

}

function updateValuesToHiddenInput() {
    const inputHidden = document.querySelector("#category_lesson");
    let values = [];
    
    selection.forEach(item => {
        values = [...values, item.id];
    })
    
    inputHidden.value = values;
}

function removeItemList() {
    const idListCategories = document.querySelectorAll(".idListCategories");
    
    idListCategories.forEach(function(elegido) {
        elegido.addEventListener("click", function(e) {
            const idCategory = parseInt(e.target.id);
            selection = selection.filter(item => item.id !== idCategory);
            e.target.remove();
            updateValuesToHiddenInput();
        })
    })
}