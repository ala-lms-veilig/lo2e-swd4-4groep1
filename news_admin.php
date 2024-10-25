<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News CRUD</title>
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
    
    <?php require 'includes/header.php'; ?>

<main id="news_admin_main">
    <form action="" id="news_form">
        <article>
            <label for="news_img_input">img link</label>
            <input id="news_img_input" type="text">
        </article>
        <article>
            <label for="news_title_input">title</label>
            <input id="news_title_input" type="text">
        </article>
        <article>
            <label for="news_text_input">text</label>
            <textarea id="news_text_input" rows="10"></textarea>
        </article>
        <article>
            <button type="button">Cancel</button>
            <button type="button">OK</button>
        </article>
    </form>
    <button type="button">Create</button>
    <table id="news_table">
        <tr>
            <th>id</th>
            <th>image</th>
            <th>title</th>
            <th>text</th>
            <th>Update</th>
            <th>Delete</th>
        </tr>
        <template id="news_template"> 
            <tr>
                <td class="news_id"></td>
                <td class="news_img"></td>
                <td class="news_title"></td>
                <td class="news_text"></td>
                <td><button class="update-btn">✏️</button></td>
                <td><button class="delete-btn">🗑️</button></td>
            </tr>
        </template>
    </table>
</main>

    <?php require 'includes/footer.php'; ?>

    <script src="scripts/news_admin.js"></script>
</body>
</html>
