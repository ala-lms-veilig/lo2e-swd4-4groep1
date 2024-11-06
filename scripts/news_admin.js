// http://localhost/Github_PHP/lo2e-swd4-4groep1/db.json
// If server doesn't work use newsInfo.newsInfo
async function showNewsInfo() {
    const response = await fetch(`https://my-json-server.typicode.com/ala-lms-veilig/lo2e-swd4-4groep1/news`);
    const newsInfo = await response.json();

    console.log(newsInfo);

    const template = document.getElementById("news_template");
    const newsTable = document.getElementById("news_table");

    
    for (let news of newsInfo) {
        const clone = template.content.cloneNode(true);

        const id        = clone.querySelector(".news_id");
        const img       = clone.querySelector(".news_img");
        const title     = clone.querySelector(".news_title");
        const text      = clone.querySelector(".news_text");

        const updateBtn = clone.querySelector(".update_button");
        const deleteBtn = clone.querySelector(".delete_button");

        clone.querySelector("tr").setAttribute("data-id", news.id);

        id.innerHTML        = news.id;
        img.innerHTML       = `<img src="images/${news.img}" alt="${news.title}">`;
        title.innerHTML     = news.title;
        text.innerHTML      = news.txt;

        updateBtn.addEventListener("click", function() {updateNewsForm(news.id, news.img, news.title, news.txt);});
        deleteBtn.addEventListener("click", function() {deleteNews(news.id);});

        newsTable.appendChild(clone);
    }
}

function updateNewsForm(id, img, title, text) {
    console.log(id);

    const form = document.getElementById("news_form");

    form.style.display = "block";

    const newsImgInput = document.getElementById("news_img_input");
    const newsTitleInput = document.getElementById("news_title_input");
    const newsTextInput = document.getElementById("news_text_input");

    newsImgInput.disabled = false;
    newsTitleInput.disabled = false;
    newsTextInput.disabled = false;

    newsImgInput.value = img;
    newsTitleInput.value = title;
    newsTextInput.value = text;

    const newsIdInput = document.getElementById("news_id_input");
    newsIdInput.value = id;
}

async function deleteNews(id) {
    console.log(id);

    const response = await fetch(`https://my-json-server.typicode.com/ala-lms-veilig/lo2e-swd4-4groep1/news/${id}`, {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json',
        }
    }); 

    if (response.ok) {
        console.log(`id ${id} deleted successfully.`);

        const rowToDelete = document.querySelector(`tr[data-id='${id}']`);
            if (rowToDelete) {
                rowToDelete.remove();
            }
    } else {
        console.log(`Failed to delete id ${id}.`);
    }
}

function createNewsForm() {
    const form = document.getElementById("news_form");
    form.style.display = "block";

    const newsImgInput = document.getElementById("news_img_input");
    const newsTitleInput = document.getElementById("news_title_input");
    const newsTextInput = document.getElementById("news_text_input");

    newsImgInput.value = '';  
    newsTitleInput.value = '';
    newsTextInput.value = ''; 

    newsImgInput.disabled = false;
    newsTitleInput.disabled = false;
    newsTextInput.disabled = false;

    const newsIdInput = document.getElementById("news_id_input");
    newsIdInput.value = '';
}

const createBtn = document.querySelector("#create_button");
createBtn.addEventListener("click", createNewsForm);


showNewsInfo();

//////////////////
// Form buttons //
//////////////////

// Cancel button //

function cancelForm() {
    const form = document.getElementById("news_form");
    form.style.display = "none";


    const newsImgInput = document.getElementById("news_img_input");
    const newsTitleInput = document.getElementById("news_title_input");
    const newsTextInput = document.getElementById("news_text_input");

    newsImgInput.value = '';
    newsTitleInput.value = '';
    newsTextInput.value = '';

    newsImgInput.disabled = true;
    newsTitleInput.disabled = true;
    newsTextInput.disabled = true;


    const newsIdInput = document.getElementById("news_id_input");
    if (newsIdInput) {
        newsIdInput.value = '';
    }
}

const cancelBtn = document.querySelector("#cancel_button");
cancelBtn.addEventListener("click", cancelForm);

// Submit button //

async function submitForm() {
    const form = document.getElementById('news_form');
    const formData = {
        id:     form.news_id_input.value,  
        img:    form.news_img_input.value, 
        naam:   form.news_title_input.value, 
        txt:    form.news_text_input.value, 
    };
    
    console.log(formData.id);
    let response;

    if (formData.id) {
        response = await fetch(`https://my-json-server.typicode.com/ala-lms-veilig/lo2e-swd4-4groep1/news/${formData.id}`, {
            method: 'PATCH',
            body: JSON.stringify(formData),
            headers: {
                'Content-type': 'application/json; charset=UTF-8',
            },
        });
    } else {
        response = await fetch('https://my-json-server.typicode.com/ala-lms-veilig/lo2e-swd4-4groep1/news', {
            method: 'POST',
            body: JSON.stringify(formData),
            headers: {
                'Content-type': 'application/json; charset=UTF-8',
            },
        });
    }

    const record = await response.json();
    console.log(record);

    cancelForm();

    const newsTable = document.getElementById("news_table");
    let rows = newsTable.querySelectorAll("tr:not(:first-child)");
    for (let i = 0; i < rows.length; i++) {
        rows[i].remove();
    }

    showNewsInfo();
}

const okBtn = document.querySelector("#ok_button");
okBtn.addEventListener("click", submitForm);
