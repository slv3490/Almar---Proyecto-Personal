(()=> {
    document.addEventListener("DOMContentLoaded", function() {
        validateCategoryOptions();
        // showCategoriesEdit();
        rolesQuery();
        rolesList();
    })
    
    //Mostrar las categorias disponibles a elegir
    async function rolesQuery() {
        try {
            const url = "/api/query-permissions-roles";
            const response = await fetch(url, {
                headers: {
                    "Authorization": "Bearer " + localStorage.getItem("token")
                }
            });
            const result = await response.json();
    
            rolesOptions(result);
        } catch (error) {
            console.log(error)
        }
    }
    
    let rolesArray = [];
    let selection = [];
    let currentSelection = [];
    
    function rolesOptions(roles) {
        const selectionCategories = document.querySelector("#select-roles");
    
        const inputHidden = document.querySelector("#roles_lesson");
    
        if(selectionCategories) {
            roles[0].forEach(e => {
                const options = document.createElement("OPTION");
                options.value = e.id;
                options.textContent = e.name
    
                rolesArray = [...rolesArray, e];
    
                selectionCategories.appendChild(options);
            });
        }
    
        if(inputHidden) {
    
            if(inputHidden.value !== "") {
                const valuesInputEdit = inputHidden.value.slice(0, -1);
                
                valuesInputEdit.split(",").forEach(function(e) {
                    const categoriesFilter = rolesArray.filter(item => item.id == e)
                    
                    selection = [...selection, categoriesFilter[0]];
                })
        
                const categoriesList = document.querySelector("#rolesList");
                while(categoriesList.firstChild) {
                    categoriesList.removeChild(categoriesList.firstChild)
                }
                selection.forEach(function(e) {
                    const listHTML = document.createElement("LI");
                    listHTML.textContent = e.name;
                    listHTML.id = e.id;
                    listHTML.classList.add("idListRoles");
                    
                    categoriesList.appendChild(listHTML);
                })
                removeItemList();
            }
        }
    
    }
    
    function validateCategoryOptions() {
        const createLessonButton = document.querySelector("#createRole");
        if(createLessonButton) {
            createLessonButton.addEventListener("click", function(e) {
                if(selection.length === 0) {
                    e.preventDefault();
                    const errorCategoryOption = document.querySelector(".error-roles-options");
                    errorCategoryOption.textContent = "Debes elegir almenos un permiso";
                }
            })
        }
    }
    
    //Listar las categorias que el usuario haya elegido
    function rolesList() {
        const selectionCategories = document.querySelector("#select-roles");
        const buttonAdd = document.querySelector("#buttonAddRole");
    
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
                
                const categoriesList = document.querySelector("#rolesList");
                while(categoriesList.firstChild) {
                    categoriesList.removeChild(categoriesList.firstChild)
                }
                selection.forEach(function(e) {
                    const listHTML = document.createElement("LI");
                    listHTML.textContent = e.name;
                    listHTML.id = e.id;
                    listHTML.classList.add("idListRoles");
                    
                    categoriesList.appendChild(listHTML);
                })
                removeItemList();
            })
        }
    
    }
    //Actualizar el input oculto
    function updateValuesToHiddenInput() {
        const inputHidden = document.querySelector("#roles_lesson");
        let values = [];
        
        selection.forEach(item => {
            values = [...values, item.id];
        })
        
        inputHidden.value = values;
    }
    
    //Remover un elemento que el usuario haya clickeado de la lista y el html
    function removeItemList() {
        const idListRoles = document.querySelectorAll(".idListRoles");
        
        idListRoles.forEach(function(elegido) {
            elegido.addEventListener("click", function(e) {
                const idCategory = parseInt(e.target.id);
                selection = selection.filter(item => item.id !== idCategory);
                e.target.remove();
                updateValuesToHiddenInput();
            })
        })
    }
})()