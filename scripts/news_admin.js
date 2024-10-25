// http://localhost/Github_PHP/lo2e-swd4-4groep1/db.json
async function showNewsInfo() {
    const response = await fetch(`https://my-json-server.typicode.com/ala-lms-veilig/lo2e-swd4-4groep1/news`);
    const newsInfo = await response.json();

    console.log(newsInfo);

    const template = document.getElementById("news_template");
    const container = document.getElementById("news_table");

    // If server doesn't work use newsInfo.newsInfo
    for (let news of newsInfo) {
        const clone = template.content.cloneNode(true);

        const id        = clone.querySelector(".news_id");
        const img       = clone.querySelector(".news_img");
        const title     = clone.querySelector(".news_title");
        const text      = clone.querySelector(".news_text");

        const updateBtn = clone.querySelector(".update_button");
        const deleteBtn = clone.querySelector(".delete_button");


        id.innerHTML        = news.id;
        img.innerHTML       = `<img src="images/${news.img}" alt="${news.title}">`;
        title.innerHTML     = news.title;
        text.innerHTML      = news.txt;

        updateBtn.addEventListener("click", function() {updateNewsForm(news.id, news.img, news.title, news.txt);});
        deleteBtn.addEventListener("click", function() {deleteNews(news.id);});

        container.appendChild(clone);
    }
}

async function updateNewsForm(id, img, title, text) {
    console.log(id);

    const form = document.getElementById("news_form");

    form.style.display = "block";

    const newsImgInput = document.getElementById("news_img_input")
    const newsTitleInput = document.getElementById("news_title_input")
    const newsTextInput = document.getElementById("news_text_input")

    newsImgInput.disabled = false;
    newsTitleInput.disabled = false;
    newsTextInput.disabled = false;

    newsImgInput.value = img;
    newsTitleInput.value = title;
    newsTextInput.value = text;

    //Where to store id, to give to the OK button.
}

async function deleteNews(id) {
    console.log(id);
}

async function createNewsForm() {
    console.log(created);
}

//const createBtn = document.querySelector(".create_button");
//createBtn.addEventListener("click", createNewsForm);

showNewsInfo();