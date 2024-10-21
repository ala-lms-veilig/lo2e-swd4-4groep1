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
            <input type="text">
            <input type="text">
        </article>
        <article>
            <button>Cancle</button>
            <button>OK</button>
        </article>
    </form>
    <table>
        <tr>
            <th>id</th>
            <th>image</th>
            <th>text</th>
            <th>Update</th>
            <th>Delete</th>
        </tr>
        <tr>
            <td>id_info</td>
            <td>img_url</td>
            <td>text_info</td>
            <td><button class="update-btn">Update</button></td>
            <td><button class="delete-btn">Delete</button></td>
        </tr>
    </table>
</main>

    <?php require 'includes/footer.php'; ?>

    <script src="scripts/news_admin.js"></script>
</body>
</html>
