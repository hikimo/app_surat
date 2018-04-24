<?php  
session_start();

include 'app/system/koneksi.php';

// Cek data
if(isset($_POST['username']) && isset($_POST['password'])){
	$username = $_POST['username'];
	$password = md5($_POST['password']);

	$sql = "SELECT * FROM petugas WHERE username='$username' AND password='$password'";
	$hasil = $konek->query($sql);
	// Cek jika data ada
	if($hasil->num_rows > 0){
		
		$hasil = $hasil->fetch_assoc();
		$_SESSION['user'] = $username;
		$_SESSION['akses'] = $hasil['hak'];
		// Cek Hak akses
		if($hasil['hak'] === 'admin')
		{
			echo "<script>alert('Kamu Berhasil login Sebagai Admin')</script>";
			echo "<script>window.location='app/admin/index.php'</script>";
		} elseif($hasil['hak'] === 'biasa')
		{
			echo "<script>alert('Kamu Berhasil login sebagai User')</script>";
			echo "<script>window.location='app/user/index.php'</script>";
		} else {
			echo "<script>alert('Gak ada Hak akses yang sesuai')</script>";
		}
	} else {
		echo "<script>alert('Username/Password Salah!')</script>";
		echo "<script>window.location='login.php'</script>";
	}
}
// Jika data kosong
else {
	echo "<script>alert('Username/Password tidak boleh kosong!')</script>";
	echo "<script>window.location='login.php'</script>";
}

?>