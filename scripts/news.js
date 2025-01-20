// http://localhost/Github_PHP/lo2e-swd4-4groep1/db.json
// https://my-json-server.typicode.com/ala-lms-veilig/lo2e-swd4-4groep1/news
async function showNewsInfo() {
    const response = await fetch('api/news.json');
    const jsonData = await response.json();
    const { news } = jsonData;

    console.log(news);

    const template = document.getElementById("news_template");
    const container = document.getElementById("news_main");

    for (let newsItem of news) {
        const clone = template.content.cloneNode(true);

        const img       = clone.querySelector(".news_img");
        const title     = clone.querySelector(".news_title");
        const text      = clone.querySelector(".news_text");

        img.innerHTML       = `<img src="images/${newsItem.img}" alt="${newsItem.title}">`;
        title.innerHTML     = newsItem.title;
        text.innerHTML      = newsItem.txt;

        container.appendChild(clone);
    }
}

showNewsInfo();