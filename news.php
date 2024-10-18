<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News</title>
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
    
    <?php require 'includes/header.php'; ?>

    <!-- Replace the sections with one template that gets data from db.json -->

    <main id="news_main">
    <template id="news_template">
        <section>
            <div class="news_img"></div>
            <h2 class="news_title">heading</h2>
            <p class="news_text">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ut quidem consequatur incidunt perspiciatis! Sit ad soluta vero incidunt esse necessitatibus officiis ullam, porro similique a, explicabo voluptates sunt tempora? Itaque!</p>
        </section>
    </template>
</main>

    <?php require 'includes/footer.php'; ?>

</body>
</html>

<script>
    // http://localhost/Github_PHP/lo2e-swd4-4groep1/db.json
    async function showNewsInfo() {
        const response = await fetch(`https://my-json-server.typicode.com/ala-lms-veilig/lo2e-swd4-4groep1/news`);
        const newsInfo = await response.json();

        console.log(newsInfo);

        const template = document.getElementById("news_template");
        const container = document.getElementById("news_main");

        // If server doesn't work use newsInfo.newsInfo
        for (let news of newsInfo) {
            const clone = template.content.cloneNode(true);

            const img       = clone.querySelector(".news_img");
            const title     = clone.querySelector(".news_title");
            const text      = clone.querySelector(".news_text");

            img.innerHTML = `<img src="images/${news.img}" alt="${news.title}">`;
            title.innerHTML     = news.title;
            text.innerHTML      = news.txt;

            container.appendChild(clone);
        }
    }

    showNewsInfo();
</script>
