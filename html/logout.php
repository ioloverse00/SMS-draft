<?php
session_start();
session_unset();
session_destroy();
header("Location: auth-login-basic.html");
exit;
?>
