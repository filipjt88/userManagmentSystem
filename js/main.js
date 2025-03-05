document.addEventListener("DOMContentLoaded", function () {
    const registerForm = document.getElementById("registerForm");

    if (registerForm) {
        registerForm.addEventListener("submit", function (event) {
            event.preventDefault();

            let name = document.getElementById("name").value;
            let email = document.getElementById("email").value;
            let password = document.getElementById("password").value;

            fetch("localhost/userManagementSystem/register.html", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ name, email, password })
            })
                .then(response => response.json())
                .then(data => {
                    document.getElementById("message").textContent = data.message;
                    document.getElementById("message").style.color = data.success ? "green" : "red";
                })
                .catch(error => console.error("Greška:", error));
        });
    }
});
