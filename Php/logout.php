<?php
session_start();
unset($_SESSION['User']);
header("location: ../Html/cereals.html");
?>