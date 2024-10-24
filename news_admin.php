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
    <form action="">
        <article>
            <label for="">img link</label>
            <input type="text">
        </article>
        <article>
            <label for="">title</label>
            <input type="text">
        </article>
        <article>
            <label for="">text</label>
            <textarea rows="10"></textarea> <!-- Changed input to textarea for multi-line text -->
        </article>
        <article>
            <button>Cancel</button>
            <button>OK</button>
        </article>
    </form>
    <table>
        <tr>
            <th>id</th>
            <th>image</th>
            <th>title</th>
            <th>text</th>
            <th>Update</th>
            <th>Delete</th>
        </tr>
        <tr>
            <td>id_info</td>
            <td><img src="img_url" alt="news image"></td>
            <td>title_info</td>
            <td>text_info</td>
            <td><button class="update-btn">✏️</button></td>
            <td><button class="delete-btn">🗑️</button></td>
        </tr>
    </table>
</main>

    <?php require 'includes/footer.php'; ?>

    <script src="scripts/news_admin.js"></script>
</body>
</html>
