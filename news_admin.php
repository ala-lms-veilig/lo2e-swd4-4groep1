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

    <script src="scripts/news_admin.js"></script>
</body>
</html>
