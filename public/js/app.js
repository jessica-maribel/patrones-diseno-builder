const API_LISTAR = "http://localhost/patrones-diseno-builder/api/inventario/listarInventario.php";
const API_CREAR = "http://localhost/patrones-diseno-builder/api/inventario/crearInventario.php";


let inventario = [];

async function cargarInventario() {
  try {
    const res = await fetch(API_LISTAR);
    const data = await res.json();
    if(data.success){
      inventario = data.data;
      renderInventario();
    }
  } catch (error) {
    console.error("Error al cargar inventario:", error);
  }
}

function renderInventario() {
  const tbody = document.querySelector("#tablaInventario tbody");
  tbody.innerHTML = "";
  inventario.forEach(item => {
    const fila = `
      <tr>
        <td>${item.codigo}</td>
        <td>${item.nombre}</td>
        <td>${item.color}</td>
        <td>${item.material}</td>
        <td>${item.fechaCompra}</td>
        <td>${item.vida_util}</td>
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
    codigo: document.getElementById("codigo").value,
    nombre: document.getElementById("nombre").value,
    color: document.getElementById("color").value,
    material: document.getElementById("material").value,
    fechaCompra: document.getElementById("fechaCompra").value,
    vida_util: document.getElementById("vida").value,
    proveedor: document.getElementById("proveedor").value,
    precio: document.getElementById("precio").value
  };

  try {
    const res = await fetch(API_CREAR, {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify(nuevo)
    });
    const data = await res.json();
    if(data.success){
      alert("Producto guardado correctamente");
      cargarInventario();
      e.target.reset();
    } else {
      alert("Error: " + data.error);
    }
  } catch (error) {
    console.error("Error al guardar producto:", error);
  }
});

cargarInventario();
