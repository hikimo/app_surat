<?php  
// Buat koneksi
$konek = new mysqli('localhost', 'root', '', 'p1');
if($konek->connect_error)
{
	echo "Oops, Nampaknya ada masalah pada koneksi kita";
}

?>