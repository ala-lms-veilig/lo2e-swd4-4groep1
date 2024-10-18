// link naar api (jsonfile)
const API_URL = "https://my-json-server.typicode.com/ala-lms-veilig/lo2e-swd4-4groep1/profile";

async function fetchData() {
    const response = await fetch(API_URL);
    const data = await response.json();
    console.log(data)
    return data;
    async function handleSubmit() {
        const username = document.getElementById('username').value;
        const password = document.getElementById('password').value;
    
        const profile = await fetchData();
    
        if (profile.Name === username && profile.Password === password) {
            document.getElementById('message').innerText = 'Inloggen succesvol!';
            console.log("uadkuf")
        } else {
            document.getElementById('message').innerText = 'Ongeldige gebruikersnaam of wachtwoord.';
            console.log("niet goed")
        }
        // Roep handleSubmit aan wanneer de pagina wordt geladen
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('loginForm').onsubmit = handleSubmit;
        });
}

}


fetchData();