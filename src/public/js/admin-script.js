document.addEventListener("DOMContentLoaded", () => {
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
});
