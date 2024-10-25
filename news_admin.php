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
    <form action="" id="news_form" style="display: none;">
        <article>
            <label for="news_img_input">img link</label>
            <input id="news_img_input" type="text" disabled>
        </article>
        <article>
            <label for="news_title_input">title</label>
            <input id="news_title_input" type="text" disabled>
        </article>
        <article>
            <label for="news_text_input">text</label>
            <textarea id="news_text_input" rows="10" disabled></textarea>
        </article>
        <article>
            <button type="button" id="cancel_button">Cancel</button>
            <button type="submit">OK</button>
        </article>
    </form>

    <section>
        <button type="button" id="create_button">Create</button>
    </section>

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
                <td><button type="button" class="update_button">✏️</button></td>
                <td><button type="button" class="delete_button">🗑️</button></td>
            </tr>
        </template>
    </table>
</main>

    <?php require 'includes/footer.php'; ?>

    <script src="scripts/news_admin.js"></script>
</body>
</html>
