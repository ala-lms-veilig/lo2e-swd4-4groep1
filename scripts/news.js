// http://localhost/Github_PHP/lo2e-swd4-4groep1/db.json
// https://my-json-server.typicode.com/ala-lms-veilig/lo2e-swd4-4groep1/news
async function showNewsInfo() {
    const response = await fetch(`api/news.json`);
    const newsInfo = await response.json();

    console.log(newsInfo);

    const template = document.getElementById("news_template");
    const container = document.getElementById("news_main");

    for (let news of newsInfo.news) {
        const clone = template.content.cloneNode(true);

        const img       = clone.querySelector(".news_img");
        const title     = clone.querySelector(".news_title");
        const text      = clone.querySelector(".news_text");

        img.innerHTML       = `<img src="images/${news.img}" alt="${news.title}">`;
        title.innerHTML     = news.title;
        text.innerHTML      = news.txt;

        container.appendChild(clone);
    }
}

showNewsInfo();