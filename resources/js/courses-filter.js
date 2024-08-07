// window.addEventListener("DOMContentLoaded", function() {
//     appFilterCourses();
// })

// function appFilterCourses() {
//     queryAllCourses();
// }

// async function queryAllCourses() {
//     try {
//         const url = "api/cursos/filter";
//         const response = await fetch(url);
//         const result = await response.json(response);

//         showAllCourses(result); 

//     } catch (error) {
//         throw(error)
//     }
// }

// function showAllCourses(courses) {
//     const divCourses = document.querySelector("#showFilteredCourses");
//     console.log(courses)
//     courses.courses.data.forEach(element => {
//         console.log(element)
//     });
    
// }