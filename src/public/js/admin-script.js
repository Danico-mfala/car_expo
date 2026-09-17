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

    // script pour la suppression des vehicules dans la BDD
    const overlay = document.querySelector(".overlay"); // garde de fou
    const btnCancel = document.querySelector(".btn-cancel"); // bouton annuler
    const btnConfirm = document.querySelector(".btn-confirm"); // button comfirmer
    const trash = document.querySelectorAll(".trashSVG"); // icon supprimer
    const edit = document.querySelectorAll(".editSVG"); // icon modification
    // donnees du formulaire de modification -- debut
    const form_update = document.getElementById("form-update"); // formulaire de modification
    const marqueVh = document.querySelector('input[name="marqueVh"]'); // input marque du vehicule
    const kmVh = document.querySelector('input[name="kmVh"]'); // input kilometrage du vehicule
    const editionVh = document.querySelector('input[name="editionVh"]'); // input edition du vehicule
    const etatVh = document.querySelector('select[name="etatVh"]'); // input etat du vehicule
    const modeleVh = document.querySelector('select[name="modeleVh"]'); // input modele du vehicule
    const prixVh = document.querySelector('input[name="prixVh"]'); // input prix du vehicule
    const modifierBtn = document.querySelector('input[name="modifier"]');
    const modifierCancel = document.querySelector(
      'input[name="annulerModifier"]',
    );
    // donnees du formulaire de modification -- fin

    // evenement lors de l'action sur le bouton de suppression -- debut
    trash.forEach((tr) => {
      tr.addEventListener("click", () => {
        overlay.classList.add("active");
        const idVehicule = tr.dataset.vehiculeId;
        const imageVehicule = tr.dataset.vehiculeImg;
        const confirmDeleteItem = async () => {
          const res = await fetch("../../page/admin/function/_delete.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({
              id: idVehicule,
              img: imageVehicule,
            }),
          });
          const output = await res.json();
          if (output.success) {
            console.log(output.message);
            document.getElementById(idVehicule).remove();
          } else {
            console.log(output.message);
          }
        };
        btnConfirm.addEventListener("click", () => {
          confirmDeleteItem();
          overlay.classList.remove("active");
        });
        btnCancel.addEventListener("click", function () {
          overlay.classList.remove("active");
        });
      });
    });
    // evenement lors de l'action sur le bouton de suppression -- fin

    // evenement lors de l'action sur le bouton de modification -- debut
    edit.forEach((ed) => {
      ed.addEventListener("click", () => {
        form_update.style.display = "block";
        const idVehicule = ed.dataset.vehiculeId ?? "";
        modifierCancel.addEventListener("click", () => {
          form_update.style.display = "none";
        });
        modifierBtn.addEventListener("click", async () => {
          const res = await fetch("../../page/admin/function/_update.php", {
            method: "POST",
            headers: {
              "Content-Type": "application/json",
            },
            body: JSON.stringify({
              id: idVehicule,
              marque: marqueVh.value,
              km: kmVh.value,
              edition: editionVh.value,
              etat: etatVh.value,
              modele: modeleVh.value,
              prix: prixVh.value,
            }),
          });

          const output = await res.json();
          if (output.success) {
            console.log(output.message);
            setTimeout(() => {
              location.reload();
            }, 800);
          } else {
            console.log(output.message);
          }
        });
      });
    });
  }
});
