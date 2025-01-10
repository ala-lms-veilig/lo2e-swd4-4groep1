<?php require_once 'includes/header.php';

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
            include "./includes/user_admin_template.php";
            echo "Je hebt toegang tot accounts met rol ID 1.";
            break;
        case 2:
            // Code to handle role ID 2
            include "./includes/user_manager.php";
            echo "Je hebt toegang tot accounts met rol ID 2.";
            break;
        default:
            // Handle other cases if necessary
            echo "Onbekende rol ID.";
            break;
    }

} catch (Exception $e) {
    $_SESSION['error_message'] = $e->getMessage();
    header("Location: inlog.php");
    exit;
}
?>
<head>
    <link rel="stylesheet" href="./styles/style.css">
</head>
<a href="index.php">home</a>
<a href="account.php">back</a>