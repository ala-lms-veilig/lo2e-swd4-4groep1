// https://my-json-server.typicode.com/ala-lms-veilig/lo2e-swd4-4groep1/user

// dit haalt informatie uit api en slaat het op in login
const Url =
  "https://my-json-server.typicode.com/ala-lms-veilig/lo2e-swd4-4groep1/user";

const response = await fetch(Url);
const users = await response.json();

console.log(Login);

document.getElementById("loginForm").addEventListener("submit", async function (event) {
    event.preventDefault();

    const username = document.getElementById("username").value;
    const password = document.getElementById("password").value;

    // Haal de lijst van gebruikers op uit de API
    const response = await fetch("https://my-json-server.typicode.com/ala-lms-veilig/lo2e-swd4-4groep1/user");
    const users = await response.json();

    // Controleer of de ingevoerde gebruikersnaam overeenkomt met een gebruikersnaam uit de API
    const user = users.find(user => user.username === username);

    if (user) {
        console.log("Gebruikersnaam komt overeen.");
    } else {
        console.log("Gebruikersnaam komt niet overeen.");
    }
});