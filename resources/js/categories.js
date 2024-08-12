if(document.querySelector(".categories-list")) {
    listCategories();
    let list = [];

    async function listCategories() {
        try {
            const url = "/api/categories-query";
            const response = await fetch(url, {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem("token")
                }
            });
            const result = await response.json();

            list = result[0];
            showCategories();

        } catch (error) {
            console.log(error);
        }
    }

    function showCategories() {
        const categorieUl = document.querySelector(".categories-list");

        if(categorieUl) {
            while(categorieUl.firstChild) {
                categorieUl.removeChild(categorieUl.firstChild);
            }

            list.forEach(element => {
                const divList = document.createElement("DIV");
                divList.classList.add("list");
        
                const listName = document.createElement("LI");
                listName.classList.add("list-name");
                listName.textContent = element.name;
        
                const divActions = document.createElement("DIV");
                divActions.classList.add("actions-list");
        
                const textEdit = document.createElement("P");
                textEdit.classList.add("button-edit");
                textEdit.textContent = "Edit";
                textEdit.onclick = function(e) {
                    editCategory({...element}, e);
                };
        
                const textRemove = document.createElement("P");
                textRemove.classList.add("button-remove");
                textRemove.textContent = "Remove";
                textRemove.onclick = function() {
                    removeCategory({...element});
                };
        
                categorieUl.appendChild(divList);
                divList.appendChild(listName);
                divList.appendChild(divActions);
                divActions.appendChild(textEdit);
                divActions.appendChild(textRemove);
            });
        }
    }

    function editCategory(element = false, e) {
        
        const idListName = e.target.parentElement.previousSibling;
        idListName.remove();
        
        const divListEdit = e.target.parentElement.parentElement;
        const theFirstChildDivList = divListEdit.firstChild

        const inputEditName = document.createElement("INPUT");
        inputEditName.classList.add("input-edit-name");
        inputEditName.value = element.name;

        const parentElementButtonSave = e.target.parentElement;
        const childElementButtonSave = parentElementButtonSave.firstChild;
        
        const textEditButtonSave = document.createElement("P");
        textEditButtonSave.classList.add("button-edit");
        textEditButtonSave.textContent = "Save";
        textEditButtonSave.onclick = function() {
            const listFilter = list.filter(item => item.id === element.id);
            listFilter[0].name = inputEditName.value;
            changeName(listFilter[0]);
        };
        
        parentElementButtonSave.insertBefore(textEditButtonSave, childElementButtonSave)
        divListEdit.insertBefore(inputEditName, theFirstChildDivList);
        
        const editButton = e.target;
        editButton.remove();
    }

    async function changeName(listInput) {
        const {id, name} = listInput;
        const data = new FormData();
        data.append("id", id);
        data.append("name", name);

        try {
            const url = `/api/update-category/${id}`;
            const response = await fetch(url, {
                method: "POST",
                body: data,
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem("token"),
                }
            })

            if(response) {
                list = list.map(listMemory => {
                    if(listMemory.id === id) {
                        listMemory.name = name;
                    }
                    return listMemory;
                })
                showCategories();
            }
            
        } catch (error) {
            console.log(error)
        }
    }

    async function  removeCategory(element) {
        const {id} = element;

        try {
            const url = `/api/delete-category/${id}`;
            const response = await fetch(url, {
                method: "DELETE",
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem("token"),
                }
            });
            const result = await response.json();

            if(result) {
                list = list.filter(item => item.id !== element.id);
                showCategories();
            }

        } catch (error) {
            console.log(error);
        }
    }
}