<?php
session_start();
session_destroy();
header("Location: ../html/HomePage/BeforeAuth.php");
exit;
?>
