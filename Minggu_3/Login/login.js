document.addEventListener('DOMContentLoaded', function() {
    const loginForm = document.querySelector('form');
    const emailInput = document.querySelector('input[type="email"]');
    const passwordInput = document.querySelector('input[type="password"]');

    loginForm.addEventListener('submit', function(event) {
        event.preventDefault();

        const emailValue = emailInput.value.trim();
        const passwordValue = passwordInput.value.trim();

        if (emailValue === '' || passwordValue === '') {
            alert('Peringatan: Email dan Password tidak boleh kosong!');
            return;
        }

        if (passwordValue.length < 6) {
            alert('Peringatan: Password harus memiliki minimal 6 karakter!');
            return;
        }

        console.log('Mencoba login dengan Email:', emailValue);
        console.log('Mencoba login dengan Password:', passwordValue);
        
        alert('Login Berhasil!');
    });
});