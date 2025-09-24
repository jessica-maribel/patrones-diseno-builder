// EndPoins
const API_LISTAR = "api/vehiculos/list.php";
const API_CREAR = "api/vehiculos/create.php";

let inventario = [];

async function cargarInventario() {
  try {
    const response = await fetch(API_LISTAR);
    inventario = await response.json();
    renderInventario();
  } catch (error) {
    console.error("Error cargando inventario:", error);
  }
}

function renderInventario() {
  const tbody = document.querySelector("#tablaInventario tbody");
  tbody.innerHTML = "";
  inventario.forEach((item, index) => {
    const fila = `
      <tr>
        <td>${item.id ?? index + 1}</td>
        <td>${item.nombre}</td>
        <td>${item.color}</td>
        <td>${item.material}</td>
        <td>${item.fechaCompra}</td>
        <td>${item.vida}</td>
        <td>${item.proveedor}</td>
        <td>$${parseFloat(item.precio).toFixed(2)}</td>
      </tr>
    `;
    tbody.insertAdjacentHTML("beforeend", fila);
  });
}

document.getElementById("inventarioForm").addEventListener("submit", async (e) => {
  e.preventDefault();

  const nuevo = {
    nombre: document.getElementById("nombre").value,
    color: document.getElementById("color").value,
    material: document.getElementById("material").value,
    fechaCompra: document.getElementById("fechaCompra").value,
    vida: document.getElementById("vida").value,
    proveedor: document.getElementById("proveedor").value,
    precio: document.getElementById("precio").value
  };

  try {
    const response = await fetch(API_CREAR, {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify(nuevo)
    });

    const result = await response.json();

    if (result.success) {
      alert("Producto creado correctamente");
      cargarInventario();
      e.target.reset();
    } else {
      alert("Error al crear: " + (result.error || "desconocido"));
    }
  } catch (error) {
    console.error("Error al crear:", error);
  }
});

cargarInventario();
