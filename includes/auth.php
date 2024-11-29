<?php
if (!isset($_SESSION['userID'])) {
    header("Location: inlog.php");
    exit;
}
?>