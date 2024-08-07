// (()=> {

//     const titleLessonField = document.querySelector("#title");
//     const descriptionLessonField = document.querySelector("#description");
//     const contentLessonField = document.querySelector("#content_uri");

//     if(titleLessonField && descriptionLessonField && contentLessonField) {

//         let arrayError = [
//             {
//                 title: "",
//                 description: "",
//                 content: ""
//             }
//         ];

//         function validateFieldsLesson() {
//             titleLessonField.addEventListener("input", function(e) {
//                 arrayError[0].title = e.target.value;
//                 console.log(arrayError);
//             });

//             descriptionLessonField.addEventListener("input", function(e) {
//                 arrayError[0].description = e.target.value;
//                 console.log(arrayError);
//             })

//             contentLessonField.addEventListener("input", function(e) {
//                 arrayError[0].description = e.target.value;
//                 console.log(arrayError);
//             })
//         }

//         validateFieldsLesson();

//         function validateTitleLesson(e) {

//         }
//     }


// })()