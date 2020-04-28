<?php
session_start();
session_destroy();
$msg = "You have Successfully loged out";
header("Location: index.php?success=$msg");
?>