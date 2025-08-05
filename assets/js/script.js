// Script js
document.addEventListener('DOMContentLoaded', () => {
    const registerForm = document.querySelector('form');
    registerForm.addEventListener('submit', function (e) {
        const firstname = document.querySelector('input[name="firstname"]');
        const lastname = document.querySelector('input[name="lastname"]');
        const email = document.querySelector('input[name="email"]');
        const password = document.querySelector('input[name="password"]');

        if (firstname.value.trim() === '' || lastname.value.trim() === '' || email.value.trim() === '' || password.value.trim() === '') {
            alert('All fields are required.');
            e.preventDefault();
        } else if (!validateEmail(email.value)) {
            alert('Please enter a valid email address.');
            e.preventDefault();
        } else if (password.value.length < 6) {
            alert('Password must be at least 6 characters long.');
            e.preventDefault();
        }
    });

    function validateEmail(email) {
        const regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
        return regex.test(email);
    }
});

