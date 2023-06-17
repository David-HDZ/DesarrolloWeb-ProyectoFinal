(function () {
  document.addEventListener("DOMContentLoaded", function () {
    const selectPrecio = document.getElementById("precio");
    const selectUbicacion = document.getElementById("ubicacion");
    const selectVentaRenta = document.getElementById("venta_renta");
    const cards = document.querySelectorAll(".catalog__card");
    const noResultsContainer = document.getElementById("noResults");

    selectPrecio.addEventListener("change", filtrarCards);
    selectUbicacion.addEventListener("change", filtrarCards);
    selectVentaRenta.addEventListener("change", filtrarCards);

    function filtrarCards() {
      const precioSeleccionado = selectPrecio.value;
      const ubicacionSeleccionada = selectUbicacion.value;
      const ventaRentaSeleccionada = selectVentaRenta.value;
      let hayResultados = false;

      cards.forEach(function (card) {
        const cardPrecio = parseInt(
          card
            .querySelector(".card__price")
            .textContent.replace("$", "")
            .replace(",", "")
        );
        const cardUbicacion = card
          .querySelector(".card__location")
          .textContent.toLowerCase();
        const cardVentaRenta = card
          .querySelector(".card__venta_renta")
          .textContent.toLowerCase();

        const cumplePrecio =
          precioSeleccionado === "todos" ||
          (precioSeleccionado === "bajo" && cardPrecio < 100000) ||
          (precioSeleccionado === "medio" &&
            cardPrecio >= 100000 &&
            cardPrecio <= 500000) ||
          (precioSeleccionado === "alto" && cardPrecio > 500000);

        const cumpleUbicacion =
          ubicacionSeleccionada === "todos" ||
          cardUbicacion.includes(ubicacionSeleccionada);

        const cumpleVentaRenta =
          ventaRentaSeleccionada === "todos" ||
          cardVentaRenta.includes(ventaRentaSeleccionada);

        const mostrarCard = cumplePrecio && cumpleUbicacion && cumpleVentaRenta;

        card.style.display = mostrarCard ? "block" : "none";

        if (mostrarCard) {
          hayResultados = true;
        }
      });

      if (!hayResultados) {
        noResultsContainer.style.display = "block";
      } else {
        noResultsContainer.style.display = "none";
      }
    }
  });
})();
