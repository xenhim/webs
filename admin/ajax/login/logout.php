<?php
session_status() === PHP_SESSION_ACTIVE ?: session_start(); 
unset($_SESSION['email']);
unset($_SESSION['password_old']);
unset($_SESSION['password_new']);
unset($_SESSION['confirm_password_new']);
exit();
?>