// https://my-json-server.typicode.com/ala-lms-veilig/lo2e-swd4-4groep1/user
// dit haalt informatie uit api en slaat het op in login

async function UserData() {
    const Url = "https://my-json-server.typicode.com/ala-lms-veilig/lo2e-swd4-4groep1/user";

    const response = await fetch(Url);
    const users = await response.json();

    console.log(users);

    document.getElementById("loginForm").addEventListener("submit", async function (event) {
        event.preventDefault();

        const username = document.getElementById("username").value;
        const password = document.getElementById("password").value;

        const user = users.find(user => user.username === username);

        if (user) {
            console.log("Gebruikersnaam komt overeen.");
        } else {
            console.log("Gebruikersnaam komt niet overeen.");
        }
    });
}