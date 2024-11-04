async function UserData() {
    const Url = "https://my-json-server.typicode.com/ala-lms-veilig/lo2e-swd4-4groep1/user";

    const response = await fetch(Url);
    const users = await response.json();

    console.log(users);

    document.getElementById("loginForm").addEventListener("submit", async function (event) {
        const username = document.getElementById("username").value;
        const password = document.getElementById("password").value;

        const user = users.find(user => user.Name === username && user.Password === password);

        const messageDiv = document.getElementById("message");

        if (user) {
            messageDiv.textContent = "Login successful!";
            messageDiv.style.color = "green";
              window.location.href = "account.php";
        } else {
            messageDiv.textContent = "Invalid username or password.";
            messageDiv.style.color = "red";
        }
    });
}

UserData();