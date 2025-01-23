/*!
    * Start Bootstrap - SB Admin v7.0.7 (https://startbootstrap.com/template/sb-admin)
    * Copyright 2013-2023 Start Bootstrap
    * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-sb-admin/blob/master/LICENSE)
    */
    // 
// Scripts
// 

window.addEventListener('DOMContentLoaded', event => {

    // Toggle the side navigation
    const sidebarToggle = document.body.querySelector('#sidebarToggle');
    if (sidebarToggle) {
        // Uncomment Below to persist sidebar toggle between refreshes
        // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
        //     document.body.classList.toggle('sb-sidenav-toggled');
        // }
        sidebarToggle.addEventListener('click', event => {
            event.preventDefault();
            document.body.classList.toggle('sb-sidenav-toggled');
            localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
        });
    }

});


document.addEventListener('DOMContentLoaded', () => {
    const menuToggle = document.querySelector('.fa-bars'); // Icono hamburguesa
    const menu = document.querySelector('.menu'); // Menú

    // Evento para abrir/cerrar el menú
    menuToggle.addEventListener('click', () => {
        menu.classList.toggle('active'); // Alternar la clase 'active'
    });

    const userMenuToggle = document.getElementById('userMenuToggle'); // Ícono de la web
    const userMenu = document.getElementById('userMenu'); // Menú desplegable

    // Evento para abrir/cerrar el menú
    userMenuToggle.addEventListener('click', (event) => {
        event.preventDefault(); // Prevenir el comportamiento por defecto
        userMenu.classList.toggle('active'); // Alternar la clase 'active'
        userMenu.style.display = userMenu.style.display === 'block' ? 'none' : 'block'; // Alternar visibilidad
    });

    // Cerrar el menú si se hace clic fuera de él
    document.addEventListener('click', (event) => {
        if (!userMenuToggle.contains(event.target) && !userMenu.contains(event.target)) {
            userMenu.style.display = 'none'; // Ocultar el menú
        }
    });
});

document.addEventListener('DOMContentLoaded', () => {
    const submitDireccion = document.getElementById('submitDireccion');
    const direccionForm = document.getElementById('direccionForm');

    submitDireccion.addEventListener('click', () => {
        const formData = new FormData(direccionForm);
        
        fetch('guardar_direccion.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Pedido realizado con éxito');
                window.location.href = '../index.php'; // Redirigir a la página principal
            } else {
                alert('Error al realizar el pedido: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });
});