<?php  
session_start();
// Cek Login
if(empty($_SESSION['user']))
{
	echo "<script>alert('Kamu belum login wah..')</script>";
	echo "<script>window.location='../../login.php'</script>";
} else {
	// Cek akses
	if($_SESSION['akses'] != 'admin')
	{
		echo "<script>alert('Kamu bukan Admin!')</script>";
		echo "<script>window.location='../user/index.php'</script>";
	} elseif($_SESSION['akses'] === NULL) {
		echo "<script>alert('Gak ada hak akses yang sesuai!')</script>";
		echo "<script>window.location='../../login.php'</script>";
		session_destroy();
	}
}


include '../layouts/header-pet.php';
include '../../system/koneksi.php';

$id_edit = $_GET['id'];
$q_pet = "SELECT * FROM petugas WHERE id=$id_edit";
$hasil = $konek->query($q_pet);
$hasil = $hasil->fetch_assoc();

?>

	<div class="w3-container w3-padding-bottom" style="padding-top: 22px">
		<div class="w3-card-4">
			<div class="w3-container w3-teal">
				<h2>Ubah Petugas</h2>
			</div>

			<div class="w3-container">
				<form method="POST">
					<p>
						<label class="w3-label" for="username">Username</label>
						<input type="text" name="username" value="<?= $hasil['username'] ?>" class="w3-input" id="username" required>
					</p>

					<p>
						<label class="w3-label" for="nama_depan">Nama Depan</label>
						<input type="text" name="nama_depan" value="<?= $hasil['nama_depan'] ?>" class="w3-input" id="nama_depan" required>
					</p>

					<p>
						<label class="w3-label" for="nama_belakang">Nama Belakang</label>
						<input type="text" name="nama_belakang" value="<?= $hasil['nama_belakang'] ?>" class="w3-input" id="nama_belakang" required>
					</p>

					<p>
						<label class="w3-label" for="password">Password</label>
						<input type="password" name="password" class="w3-input" id="password" required>
					</p>

					<p>
						<label class="w3-label" for="hak">Hak</label>
						<select name="hak" class="w3-select" required>
							<option value="admin">admin</option>
							<option value="biasa" selected>biasa</option>
						</select>	
					</p>

					<p>
						<button class="w3-btn w3-teal" name="simpan"><i class="fa fa-save"></i> Simpan</button>
					</p>
				</form>
			</div>
		</div>
	</div>
	
<?php 
include '../layouts/footer.php';

// Cek data masuk
if(isset($_POST['simpan']))
{
	$username = $_POST['username'];
	$nama_depan = $_POST['nama_depan'];
	$nama_belakang = $_POST['nama_belakang'];
	$password = md5($_POST['password']);
	$hak = $_POST['hak'];

	$sql = "UPDATE petugas SET username='$username', nama_depan='$nama_depan', nama_belakang='$nama_belakang', password='$password', hak='$hak' WHERE id=$id_edit";

	// Mari jalankan query
	if($konek->query($sql) === TRUE)
	{
		echo "<script>alert('Data berhasil berubah! :D')</script>";
		echo "<script>window.location='index.php'</script>";
	} else {
		echo "<script>alert('Data gak berubah')</script>";
		echo "<script>window.location='index.php'</script>";
	}
}
?>