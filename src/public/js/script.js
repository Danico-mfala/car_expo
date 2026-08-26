document.addEventListener("DOMContentLoaded", () => {
  const buy_sub = document.getElementById("buy_sub");
  const buy_form = document.getElementById("buy_form");
  const btn_close = document.getElementById("btn_close");

  const filterSelect = document.getElementById("filterSelect");
  const searchInput = document.getElementById("searchInput");
  const macthForm = document.getElementById("macthForm");

  let timer;

  searchInput.addEventListener("input", function () {
    clearTimeout(timer);
    timer = setTimeout(() => {
      macthForm.submit();
    }, 500);
  });

  filterSelect.addEventListener("change", function () {
    macthForm.submit();
  });

  buy_sub.addEventListener("click", function () {
    buy_form.classList.add("active");
  });

  btn_close.addEventListener("click", function () {
    clearTimeout(timer);
    timer = setTimeout(() => {
      buy_form.classList.remove("active");
    }, 500);
  });
});
