// const overlay = document.querySelector(".overlay");
// const btnCancel = document.querySelector(".btn-cancel");
// const btnConfirm = document.querySelector(".btn-confirm");
// const trash = document.querySelectorAll(".trashSVG");
// trash.forEach((tr) => {
//   tr.addEventListener("click", () => {
//     overlay.classList.add("active");
//   });
// });
// btnCancel.addEventListener("click", () => {
//   overlay.classList.remove("active");
// });
// function comfirmDelete(id) {
//   fetch("_delete.php", {
//     method: "POST",
//     headers: {
//       "Content-Type": "application/x-www-form-urlencod",
//     },
//     body: "id=" + encodeURIComponent(id),
//   })
//     .then((response) => response.text())
//     .then((data) => {
//       console.log("reponse du serveur" + data);
//       if (data === "success") {
//         alert("element supprimer");
//         document.querySelector("" + id).remove;
//       } else {
//         console.log("erreur de suppression" + data);
//       }
//     })
//     .catch((error) => console.error("erreur:", error));
// }
