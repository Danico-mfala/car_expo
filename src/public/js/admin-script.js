document.addEventListener("DOMContentLoaded", () => {
  // script pour colore l'input file si il ne pas vide -- debut
  // pour le fichier _add_car.php
  const fileInputs = document.querySelectorAll(
    ".custom-file-upload input[type='file']",
  );

  fileInputs.forEach((input) => {
    input.addEventListener("change", function () {
      const icon = this.previousElementSibling;

      if (this.files.length > 0) {
        icon.style.color = "#00bfa6"; // vert si fichier choisi
      } else {
        icon.style.color = "#7f8996"; // gris si aucun fichier
      }
    });
  });
  // script pour colore l'input file si il ne pas vide -- fin
  // script pour la recherche et le filtrage des vehicule -- debut
  const urlOrgin = window.location.origin;
  const urlSearch = window.location.search;
  let cardCat = document.querySelectorAll(".card-cat");
  /*function createPara() {
    // fontion aucune vehicule trouver debut
    const paragraphe = document.createElement("p");
    const contentParagraphe = document.createTextNode(
      "aucun voiture disponible",
    );
    paragraphe.appendChild(contentParagraphe);
    document.body.insertBefore(paragraphe, cardCat);
  } // fontion aucune vehicule trouver fin*/
  if (urlOrgin === "http://localhost:9000" && urlSearch === "?page=all") {
    const searchInput = document.querySelector(".nav_all > input");
    const searchSelect = document.querySelector(".nav_all > select");
    // filtrage selon la marque
    searchSelect.addEventListener("change", function () {
      const filter = searchSelect.value.toLowerCase().trim();
      cardCat.forEach((card) => {
        const textCard = card.textContent.toLowerCase().trim();

        if (textCard.includes(filter)) {
          card.style.display = "block";
        } else {
          card.style.display = "none";
        }
      });
    });
    // recherche selon la marque
    searchInput.addEventListener("input", () => {
      const search = searchInput.value.toLowerCase().trim();
      cardCat.forEach((card) => {
        const textCard = card.textContent.toLowerCase().trim();

        if (textCard.includes(search)) {
          card.style.display = "block";
        } else {
          card.style.display = "none";
        }
      });
    });
    // script pour la recherche et le filtrage des vehicule -- fin
    const overlay = document.querySelector(".overlay");
    const btnCancel = document.querySelector(".btn-cancel");
    const btnConfirm = document.querySelector(".btn-confirm");
    const trash = document.querySelectorAll(".trashSVG");
    trash.forEach((tr) => {
      tr.addEventListener("click", () => {
        overlay.classList.add("active");
        const idItem = tr.id;
        const confirmDeleteItem = async (id) => {
          const res = await fetch(
            `../../page/admin/function/_delete.php?id=${id}`,
            {
              method: "GET",
            },
          );
          const output = await res.json();
          if (output.success) {
            console.log(output.message);
            document.getElementById(idItem).remove();
          } else {
            console.log(output.message);
          }
        };
        btnConfirm.addEventListener("click", () => {
          confirmDeleteItem(idItem);
          overlay.classList.remove("active");
        });
      });
    });
    btnCancel.addEventListener("click", () => {
      overlay.classList.remove("active");
    });
  }
});
