<?php
session_start();
session_unset();
session_destroy();
header("Location: includes/inlog.php");
exit();
?>