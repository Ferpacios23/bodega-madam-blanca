let productos = {
    data: [
        {
            Nombre: "Collar de cuentas",
            categoria: "Joyerias",
            precio: "20.000",
            imagen: "../img/joyeria.jpg",
        },
        {
            Nombre: "Canasta de fibras",
            categoria: "Canastas",
            precio: "90.000",
            imagen: "../img/producto2.jpg",
        },
        {
            Nombre: "Bolso de rafia",
            categoria: "Bolsos",
            precio: "200.000",
            imagen: "../img/image.png",
        },
        {
            Nombre: "Bolso artesanal",
            categoria: "Bolsos",
            precio: "250.000",
            imagen: "../img/bolsos.png",
        },
        {
            Nombre: "Bolso artesanal",
            categoria: "Bolsos",
            precio: "250.000",
            imagen: "../img/bolsos(1).jpg",
        },
        {
            Nombre: "Bolso artesanal",
            categoria: "Bolsos",
            precio: "250.000",
            imagen: "../img/bolsos(2).jpg",
        },
    ]
};

// Función para mostrar productos
function mostrarProductos(productosFiltrados) {
    const contenedor = document.getElementById("productos");
    contenedor.innerHTML = ""; // Limpiar productos anteriores

    for (let i of productosFiltrados) {
        // Crear la tarjeta
        let card = document.createElement("div");
        card.classList.add("cartas", i.categoria.toLowerCase());

        // Contenedor de imagen
        let imgContainer = document.createElement("div");
        imgContainer.classList.add("contenedor_imagen");

        let image = document.createElement("img");
        image.setAttribute("src", i.imagen);
        imgContainer.appendChild(image);
        card.appendChild(imgContainer);

        // Nombre del producto
        let nombre = document.createElement("h5");
        nombre.textContent = i.Nombre;
        card.appendChild(nombre);

        // Precio del producto
        let precio = document.createElement("p");
        precio.textContent = "$" + i.precio;
        card.appendChild(precio);

        // Añadir la tarjeta al contenedor principal
        contenedor.appendChild(card);
    }
}

// Mostrar todos los productos inicialmente
mostrarProductos(productos.data);

// Filtrar productos al hacer clic en los botones
document.querySelectorAll(".button-value").forEach(button => {
    button.addEventListener("click", function () {
        const categoria = this.textContent.toLowerCase();
        if (categoria === "todos") {
            mostrarProductos(productos.data);
        } else {
            const productosFiltrados = productos.data.filter(
                item => item.categoria.toLowerCase() === categoria
            );
            mostrarProductos(productosFiltrados);
        }
    });
});

// Filtrar productos mediante el buscador
document.getElementById("search-input").addEventListener("input", function () {
    const query = this.value.toLowerCase().trim();
    const productosFiltrados = productos.data.filter(item =>
        item.Nombre.toLowerCase().includes(query) || 
        item.categoria.toLowerCase().includes(query)
    );
    mostrarProductos(productosFiltrados);
});
