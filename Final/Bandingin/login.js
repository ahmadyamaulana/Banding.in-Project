document.addEventListener('DOMContentLoaded', function() {
    const loginForm = document.querySelector('form');
    const emailInput = document.querySelector('input[type="email"]');
    const passwordInput = document.querySelector('input[type="password"]');
    const linkLupaPassword = document.querySelector('.forgot-password a');

    linkLupaPassword.addEventListener('click', function(event) {
        event.preventDefault(); 
        
        alert("Kasihan lupa password awokawokawok.");
    });

});