function init() {
  const URL_OLLAMA = "https://45c39936668d.ngrok-free.app/api/generate";

  const btnOllama = document.querySelector("#btnOllama");
  btnOllama.addEventListener("click", async (e) => {
    e.preventDefault();
    const producto = await fetchProductos();
    if (producto) {
      const { nombre, precio, descripcion } = producto.producto;
      document.querySelector("[name='nombre_producto']").value = nombre;
      document.querySelector("[name='precio_producto']").value =
        typeof precio === "string"
          ? parseFloat(precio.replace("$", ""))
          : precio;
      document.querySelector("[name='descripcion_producto']").value =
        descripcion;
    }
  });

  async function fetchProductos() {
    const response = await fetch(URL_OLLAMA, {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({
        model: "qwen-json",
        prompt:
          "Genera solo un producto que tenga las propiedades nombre, precio y descripción. Estos productos son de caracter tecnológico. Escoge de una tablet, laptop o smartphone y puede ser de la marca apple, samsung, xiaomi entre otros. Genera valores aleatorios para no repetir",
        format: "json",
        stream: false,
      }),
    });
    if (!response.ok) {
      throw new Error("Ocuriró un error al llamar al servicio de Ollama");
    }
    try {
      const data = await response.json();
      return JSON.parse(data.response);
    } catch (err) {
      console.error(err);
      return null;
    }
  }
}

window.addEventListener("load", init);
