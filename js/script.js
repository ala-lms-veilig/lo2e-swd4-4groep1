async function createIncident() {
    try {
        data = {
            priority: document.getElementById("priorities").value,
            category: document.getElementById("categories").value,
            title: document.getElementById("new-incident-title-input").value,
            media: "test",
            description: document.getElementById("new-incident-description-input").value,
            tower: document.getElementById("towers").value,
            floor: document.getElementById("floors").value,
            class_area: document.getElementById("new-incident-class_area-input").value
        }
        console.log(data);
        const response = await fetch('./includes/api.php?action=createIncident', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(data)
        });

        const result = await responseHandler(response);
        window.location.href = `melding.php?id=${result.newIncidentID}`;
        } catch (error) {
            console.log(JSON.stringify(data));
            errorHandler(error, 'createIncident');
        }
}

function getFileName(event, page) {
    try {
        const files = event.target.files;
        const fileName = files[0].name;
        if (page == "new_incident") {
            document.getElementById("media-delete-button").style.display = "block";
            document.getElementById("media-button").innerHTML = fileName;
        } else if (page == "single_incident") {
            document.getElementById("message-media-path-container").style.display = "flex";
            document.getElementById("message-media-path").innerHTML = fileName;
        }
    } catch (error) {
        errorHandler(error, 'getFileName');
    }
}

function resetFileInput(page) {
    try {
        if (page == "new_incident") {
            document.getElementById("media-input").value = "";
            document.getElementById("media-delete-button").style.display = "none";
            if (document.getElementById("media-input").value == "") {
                document.getElementById("media-button").innerHTML = "Voeg media toe"
            } else {
                console.log(document.getElementById("media-input").value)
            }
        } else if (page == "single_incident") {
            document.getElementById("media-input").value = "";
            document.getElementById("message-media-path-container").style.display = "none";
        } 
    } catch (error) {
        errorHandler(error, 'resetFileInput');
    }
}

function newIncidentEventListeners() {
    document.getElementById("media-input").addEventListener("change", (event) => getFileName(event, "new_incident"));
    getLocation()
}

function incidentEventListeners() {
        document.getElementById("media-input").addEventListener("change", (event) => getFileName(event, "single_incident"));
}

async function showIncidents() {
    id = new URLSearchParams(window.location.search).get("id");
    console.log(id);
    if (id == undefined) {
        try {
            const response = await fetch('./includes/api.php?action=showIncidents');
            const incidents = await responseHandler(response);
            const incidentsContainer = document.getElementById('incidents-container');
            const incidentTemplate = document.querySelector('.incident-template');

            incidentsContainer.innerHTML = '';
            console.log(incidents);
            if (Array.isArray(incidents)) {
                incidents.forEach((incident) => {
                    console.log(incident);
                    const clone = incidentTemplate.content.cloneNode(true);

                    clone.querySelector('.incident-id').textContent = incident.id;
                    clone.querySelector(".incident-titles").textContent = incident.title;
                    clone.querySelector(".incident-description").textContent = incident.description;
                    clone.querySelector(".incident-category").textContent = incident.category;
                    clone.querySelector(".incident-priority").textContent = incident.priority;
                    clone.querySelector(".incident-status").textContent = incident.status;
                    clone.querySelector(".incident-goto-button").href = "melding.php?id=" + incident.id;
                    clone.querySelector(".incident-delete-button").href = "javascript:deleteIncident(" + incident.id + ")";

                    incidentsContainer.appendChild(clone);
                })
            };
        } catch (error) {
            errorHandler(error, 'showIncidents')
        }
    } else {
        console.log("id detected")
        try {
            const response = await fetch(`./includes/api.php?action=showIncidents&id=${id}`);
            const incident = await responseHandler(response);

            const incidentDetailsContainer = document.getElementById('single-incident-details-container');
            const incidentDetailsTemplate = document.querySelector('.single-incident-details-template');

            const clone = incidentDetailsTemplate.content.cloneNode(true);
            console.log(incident);
            clone.querySelector('.id-author').textContent = incident.name;
            clone.querySelector(".id-category").textContent = incident.category;
            clone.querySelector(".id-priority").textContent = incident.priority;
            clone.querySelector(".id-create_date").textContent = incident.create_date;
            clone.querySelector(".id-status").textContent = incident.status;
            clone.querySelector(".id-tower").textContent = incident.tower;
            clone.querySelector(".id-floor").textContent = incident.floor;
            clone.querySelector(".id-class_area").textContent = incident.class_area;
            clone.querySelector(".id-update_date").textContent = incident.last_updated;

            incidentDetailsContainer.appendChild(clone);
            console.log(incident);
        } catch (error) {
            errorHandler(error, 'showIncidents')
        }
    }
}


async function deleteIncident(incidentID) {
    try {
        const response = await fetch('./includes/api.php?action=deleteIncident&incidentID=' + incidentID, {
            method: 'POST',
        });

        const result = await responseHandler(response);
        if (result.success) {
            await showIncidents();
        }
    } catch (error) {
        errorHandler(error, 'deleteIncident');
    }
}


async function responseHandler(response) {
    if (!response.ok) {
        const errorDetails = response.text();
        throw new Error(`API request failed with status ${response.status}: ${errorDetails}`);
    }
    return await response.json();
}

function errorHandler(error, context) {
    console.error(`Error in ${context}: `, error);
    alert(`An error occurred. Please try again later.`);
}

async function login() {
    try {
        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;
        console.log(email, password);

        const response = await fetch('./includes/api.php?action=login', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                username: email,
                password: password,
            }),
        });
        
        console.log(response);
        const result = await responseHandler(response);

        if (result.success) {
            console.log('Login successful:', result.message);
            window.location.href = 'dashboard.php';
        } else {
            errorHandler(error, "login")
        }
    } catch (error) {
        errorHandler(error, 'login');
    }
}

function insertBlueprintLinks() {
    cells = document.querySelectorAll('.blueprint-cell');
    var tower;
    for (var i = 0; i < cells.length; i++) {
        switch(true) {
            case cells[i].classList.contains("red"):
                var tower = "A";
                break;
            
            case cells[i].classList.contains("pink"):
                var tower = "B";
                break;

            case cells[i].classList.contains("purple"):
                var tower = "C";
                break;

            case cells[i].classList.contains("cyan"):
                var tower = "D";
                break;

            case cells[i].classList.contains("green"):
                var tower = "E";
                break;
        }

        cells[i].href = "melding_aanmaken.php?Toren=" + tower + "&Verdieping=" + cells[i].innerHTML;
    }
}

function getLocation() {
    towerInput = document.getElementById("towers");
    floorInput = document.getElementById("floors");


    selectedTower = new URLSearchParams(window.location.search).get("Toren");
    selectedFloor = new URLSearchParams(window.location.search).get("Verdieping");

    console.log(selectedTower)
    towerInput.value = selectedTower;
    floorInput.value = selectedFloor;
}

async function getChatMessages() {
    const incidentID = new URLSearchParams(window.location.search).get("id");
    const response = await fetch(`./includes/api.php?action=getChatMessages&id=${incidentID}`);
    const replies = await responseHandler(response);


    const repliesContainer = document.getElementById('chat-messages-container');
    const messageTemplate = document.getElementById('message-template');
    const dateTemplate = document.getElementById('message-date-template');

    messages = replies.message;
    loggedInUserID = replies.loggedInUserID;
    staffMessagesUserIDs = replies.staffMessagesUserIDs;
    
    repliesContainer.innerHTML = '';

    lastMessageDate = null;

    if (Array.isArray(messages)) {
        console.log("is array")
        messages.forEach((message) => {
            const clone = messageTemplate.content.cloneNode(true);
            time = new Date(message.time);
            console.log((time.getMonth() + 1));
            if (lastMessageDate != time.getDate() + "/" + (time.getMonth() + 1)) {
                console.log("test")
                const clone = dateTemplate.content.cloneNode(true);
                clone.querySelector('.message-date').textContent = time.getDate() + "/" + (time.getMonth() + 1) + "/" + time.getFullYear();
                repliesContainer.appendChild(clone);
            }
            message.time = time.getHours() + ":" + time.getMinutes();

            clone.querySelector('.chat-name').textContent = message.name;
            clone.querySelector('.chat-time').textContent = message.time;
            clone.querySelector('.chat-message').textContent = message.message;
            

            if (staffMessagesUserIDs.some(staffIDs => staffIDs.user_id === loggedInUserID)) {
                console.log("logged in user is staff")
                if (staffMessagesUserIDs.some(staffIDs => staffIDs.user_id === message.user_id)) {
                    console.log("Logged in user is staff and message is sent by staff")
                    clone.querySelector('.message').classList.add("own")
                    repliesContainer.appendChild(clone);
                } else {
                    console.log("Message not sent by staff")
                    
            repliesContainer.appendChild(clone);
                }
            } else {
                if (staffMessagesUserIDs.some(staffIDs => staffIDs.user_id === message.user_id)) {
                    console.log("Logged in user is not staff, but message is sent by staff")
                    repliesContainer.appendChild(clone);
                } else {
                console.log("Logged in user is not staff")
                clone.querySelector('.message').classList.add("own")
                repliesContainer.appendChild(clone);
                }
            }
            lastMessageDate = time.getDate() + "/" + (time.getMonth() + 1);
        })
    };
}

async function sendChatMessage() {
    try {
        data = {
            media: document.getElementById("media-input").value || null,
            message: document.getElementById("message-input").value,
            incidentID: new URLSearchParams(window.location.search).get("id"),
        }
        const response = await fetch('./includes/api.php?action=sendChatMessage', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(data)
        });

        const result = await responseHandler(response);
        getChatMessages();
        document.getElementById("message-input").value = "";
        } catch (error) {
            errorHandler(error, 'sendChatMessage');
        }
}