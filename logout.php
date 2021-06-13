<?php

session_start();

if(isset($_SESSION['dr_username']))
{
	unset($_SESSION['dr_username']);

}

header("Location: login.php");
die;