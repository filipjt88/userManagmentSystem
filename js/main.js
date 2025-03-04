document.addEventListener("DOMContentLoaded", function () {
    document.querySelector("#registerFrom").addEventListener("submit", function (e) {
        e.preventDefault();

        let name = document.querySelector("#name").value;
        let email = document.querySelector("#email").value;
        let password = document.querySelector("#password").value;

        fetch("http://localhost/userManagmentSystem/register.html", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: `name=${encodeURIComponent(name)}&email=${encodeURIComponent(email)}&password=${encodeURIComponent(password)}`
        })
            .then(response => response.json())
            .then(data => {
                document.querySelector("#message").textContent = data.message;
                if (data.success) {
                    document.querySelector("#message").style.color = "green";
                } else {
                    document.querySelector("#message").style.color = "red";
                }
            })
            .catch(error => console.error("Error:", error));
    });
})
