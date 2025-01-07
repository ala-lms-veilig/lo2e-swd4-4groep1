<?php require_once 'includes/header.php';

try {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
        throw new Exception("Je moet ingelogd zijn om deze pagina te bekijken.");
    }

    if (!isset($_SESSION['role_id'])) {
        throw new Exception("Rol ID niet gevonden.");
    }

    $role_id = $_SESSION['role_id'];

    if ($role_id == 0) {
        header("Location: index.php");
        exit;
    } elseif ($role_id == 2) {
        // Code to display only accounts with a role ID of 0
        // Example code to fetch and display accounts
        try {
            // Assuming you have a database connection $conn
            $stmt = $conn->prepare("SELECT * FROM accounts WHERE role_id = 0");
            $stmt->execute();
            $accounts = $stmt->fetchAll();

            foreach ($accounts as $account) {
                echo "Account: " . $account['username'] . "<br>";
            }
        } catch (Exception $e) {
            throw new Exception("Fout bij het ophalen van accounts: " . $e->getMessage());
        }
    }
} catch (Exception $e) {
    $_SESSION['error_message'] = $e->getMessage();
    header("Location: inlog.php");
    exit;
}
?>

<a href="index.php">home</a>
<a href="account.php">back</a>