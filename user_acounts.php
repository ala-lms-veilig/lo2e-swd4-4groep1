<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>accounts</title>
    <link rel="stylesheet" href="./styles/style.css">
</head>
<body>
<?php require_once 'includes/header.php'; ?>

<div class="container">
    <?php
    try {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
            throw new Exception("Je moet ingelogd zijn om deze pagina te bekijken.");
        }

        if (!isset($_SESSION['rol_id'])) {
            throw new Exception("Rol ID niet gevonden.");
        }

        $role_id = $_SESSION['rol_id'];
        switch ($role_id) {
            case 0:
                header("Location: index.php");
                exit;
            case 1:
                // Code to handle role ID 1
                echo '<section id="admin-section">';
                include "./includes/user_admin_template.php";
                echo '</section>';
                break;
            case 2:
                // Code to handle role ID 2
                echo '<section id="manager-section">';
                include "./includes/user_manager.php";
                echo '</section>';
                break;
            default:
                // Handle other cases if necessary
                echo '<section id="unknown-role-section">';
                header("Location: inlog.php");
                echo '</section>';
                break;
        }

    } catch (Exception $e) {
        $_SESSION['error_message'] = $e->getMessage();
        header("Location: inlog.php");
        exit;
    }
    ?>
    <nav class="navigation">
        <a class="nav-link" href="index.php">home</a>
        <a class="nav-link" href="account.php">back</a>
    </nav>
</div>
</body>
</html>