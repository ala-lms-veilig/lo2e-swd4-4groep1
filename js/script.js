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
        console.log(JSON.stringify(data));
        const response = await fetch('./includes/api.php?action=createIncident', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(data)
        });

        const result = await responseHandler(response);
        console.log(result);
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

function incidentsEventListeners() {
    const filterInputs = document.querySelectorAll(".filter-input");
    console.log(filterInputs);
    const dropdownButtons = document.querySelectorAll(".dropdown-button");
    const dropdownMenus = document.querySelectorAll(".dropdown-menu");

    dropdownButtons.forEach((button, index) => {
        const menu = dropdownMenus[index];

        const setRadius = (isHovered) => {
            if (isHovered) {
                button.style.borderBottomLeftRadius = "0";
                button.style.borderBottomRightRadius = "0";
                menu.style.borderTopLeftRadius = "0";
                menu.style.borderTopRightRadius = "0";
            } else {
                button.style.borderBottomLeftRadius = "5px";
                button.style.borderBottomRightRadius = "5px";
                menu.style.borderTopLeftRadius = "5px";
                menu.style.borderTopRightRadius = "5px";
            }
        };

        button.addEventListener("mouseenter", () => setRadius(true));
        button.addEventListener("mouseleave", () => setRadius(false));

        menu.addEventListener("mouseenter", () => setRadius(true));
        menu.addEventListener("mouseleave", () => setRadius(false));
    });

    filterInputs.forEach((element) => {
        element.addEventListener("change", getFilters());
    })
}

function getFilters() {
    console.log("hi")
}

function editIncident() {
    id = new URLSearchParams(window.location.search).get("id");
    editableElements = document.querySelectorAll(".editable")
    editableElements.forEach(makeEditable);

    document.getElementById("single-incident-edit-button").innerHTML = "Opslaan";
    document.getElementById("single-incident-edit-button").setAttribute( "onClick", "javascript:saveEdits("+ id + ")")
}

async function saveEdits(id) {
    inputs = document.querySelectorAll(".editable-input");
    console.log(inputs)
    data = {
        title: inputs[0].value,
        description: inputs[1].value,
        note: inputs[2].value,
        category: inputs[3].value,
        priority: inputs[4].value,
        status: inputs[5].value,
        tower: inputs[6].value,
        floor: inputs[7].value,
        class_area: inputs[8].value,
        id: id
    }
    try {
    const response = await fetch('./includes/api.php?action=editIncident', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(data)
    });

        const result = await responseHandler(response);
        
        location.reload();
    }   catch (error) {
        errorHandler(error, 'editIncident');
    }
}

function makeEditable(element) {
    const input = document.createElement('input');
    
    input.type = "text";
    input.value = element.textContent
    
    input.className = "editable-input";
    
    element.parentNode.replaceChild(input, element);
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
            const incidentDetails = await responseHandler(response);
            const incident = incidentDetails.incident;
            const rights = incidentDetails.rights;

            if (rights.includes("view_notes") == true) {
                const incidentNotesContainer = document.getElementById("texts-container");
                const incidentNotesTemplate = document.querySelector(".incident-notes-container-template");
                const notesClone = incidentNotesTemplate.content.cloneNode(true);
                notesClone.querySelector(".internal-note").textContent = incident.note;
                incidentNotesContainer.appendChild(notesClone)
            }

            const incidentTitleContainer = document.getElementById("incident-infos-container");
            const incidentTitleTemplate = document.querySelector(".incident-title-template");

            titleClone = incidentTitleTemplate.content.cloneNode(true);
            titleClone.querySelector(".single-incident-titles").textContent = incident.title;
            titleClone.querySelector(".single-incident-texts").textContent = incident.description;
            incidentTitleContainer.appendChild(titleClone)

            const incidentDetailsContainer = document.getElementById('single-incident-details-container');
            const incidentDetailsTemplate = document.querySelector('.single-incident-details-template');

            const detailsClone = incidentDetailsTemplate.content.cloneNode(true);
            console.log(incident);
            detailsClone.querySelector('.id-author').textContent = incident.name;
            detailsClone.querySelector(".id-category").textContent = incident.category;
            detailsClone.querySelector(".id-priority").textContent = incident.priority;
            detailsClone.querySelector(".id-create_date").textContent = incident.create_date;
            detailsClone.querySelector(".id-status").textContent = incident.status;
            detailsClone.querySelector(".id-tower").textContent = incident.tower;
            detailsClone.querySelector(".id-floor").textContent = incident.floor;
            detailsClone.querySelector(".id-class_area").textContent = incident.class_area;
            detailsClone.querySelector(".id-update_date").textContent = incident.last_updated;

            incidentDetailsContainer.appendChild(detailsClone);
            console.log(rights);

            if (rights.includes("manage_incidents") == true) {
                console.log("true")
                const editButtonContainer = document.getElementById("single-incident-details-container");
                const editButtonTemplate = document.querySelector(".edit-button-template");
                const editClone = editButtonTemplate.content.cloneNode(true);
                editButtonContainer.appendChild(editClone)
            } else {
                console.log("false")
            }
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