<?php  
session_start();
// Cek akses
if(empty($_SESSION['user']) && empty($_SESSION['akses']))
{
	header('Location: login.php');
} else {
	// Cek akses
	if($_SESSION['akses'] === 'admin')
	{
		header('Location: app/admin');
	} else {
		header('Location: app/user');
	}
}

?>