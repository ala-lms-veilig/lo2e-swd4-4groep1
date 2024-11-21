<?php
session_start();
session_unset();
session_destroy();
echo " logout is gelukt ";
sleep(1);
header("Location: ../inlog.php");
exit();
?>