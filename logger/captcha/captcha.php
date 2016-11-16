<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] <> "POST") 
	die("You can only reach this page by posting from the html form");

if (($_REQUEST["logger_captcha"] == $_SESSION["security_code"]) && (!empty($_REQUEST["logger_captcha"]) && !empty($_SESSION["security_code"]))) {
	echo "logger_captcha_1";
}else {
	echo "logger_captcha_0";
}
?>