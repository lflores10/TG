<?
	session_start();
   unset($_SESSION["user"]);
	header("Location: ../tecnoadmin/");
	die();
?>
