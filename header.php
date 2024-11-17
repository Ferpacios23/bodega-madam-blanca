<header>
    <div class="container-hero">
        <div class="container hero">
            <div class="customer-support">
                <i class="fa-solid fa-headset"></i>
                <div class="content-customer-support">
                    <span class="text">Soporte al cliente</span>
                    <span class="number">123-456-7890</span>
                </div>
            </div>

            <div class="container-logo">
                <h1 class="logo">
                    <a href="./index.php">
                    <img src="./assets/icon/image-removebg-preview (1).png" alt="logo principal">
                    </a>
                </h1>
            </div>

            <div class="container-user">
                <a href="./login.php"><i class="fa-solid fa-user"></i></a>

                <a href="carrito.php"><i class="fa-solid fa-basket-shopping"></i></a>
                <div class="content-shopping-cart">
                    <span class="text">Carrito</span>
                    <span class="number">
                        <?php
                        // Verificar si la sesión está iniciada
                        if (isset($_SESSION['carrito'])) {
                            // Si el carrito tiene productos, mostrar la suma
                            echo '(' . array_sum($_SESSION['carrito']) . ')';
                        } else {
                            // Si no hay sesión, mostrar cero
                            echo '(0)';
                        }
                        ?>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="container-navbar">
        <nav class="navbar container p-3">
            <i class="fa-solid fa-bars"></i>
            <ul class="menu">
                <li><a href="./index.php">Inicio</a></li>
                <li><a href="./nosotros.php">Nosotros</a></li>
                <li><a href="./tienda.php">Tienda</a></li>
                <li><a href="./contacto.php">Contacto</a></li>
            </ul>
        </nav>
    </div>
</header>
