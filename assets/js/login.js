const 
    container = document.querySelector(".container2"),
    signUp = document.querySelector(".registro"),
    login = document.querySelector(".inicio-de-sesión");

    // Código JS para que aparezca el formulario de registro e inicio de sesión
    signUp.addEventListener("click", ( )=>{
        container.classList.add("active2");
    });
    login.addEventListener("click", ( )=>{
        container.classList.remove("active2");
    });