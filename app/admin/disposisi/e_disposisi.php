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


include '../layouts/header-dis.php';
include '../../system/koneksi.php';

$no_edit = $_GET['no_disposisi'];
$q_pet = "SELECT * FROM disposisi WHERE no_disposisi='$no_edit'";
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
						<label class="w3-label" for="no_agenda">No Agenda</label>
						<input type="number" name="no_agenda" value="<?= $hasil['no_agenda'] ?>" class="w3-input" id="no_agenda" required>
					</p>

					<p>
						<label class="w3-label" for="no_surat">No Surat</label>
						<input type="text" name="no_surat" value="<?= $hasil['no_surat'] ?>" class="w3-input" id="no_surat" required>
					</p>

					<p>
						<label class="w3-label" for="kepada">Kepada</label>
						<input type="text" name="kepada" value="<?= $hasil['kepada'] ?>" class="w3-input" id="kepada" required>
					</p>

					<p>
						<label class="w3-label" for="status_surat">Status Surat</label>
						<input type="text" name="status_surat" value="<?= $hasil['status_surat'] ?>" class="w3-input" id="status_surat" required>
					</p>

					<p>
						<label class="w3-label" for="tanggapan">Disposisi</label>
						<input type="text" name="tanggapan" value="<?= $hasil['tanggapan'] ?>" class="w3-input" id="tanggapan" required>
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
	$no_disposisi = $_POST['no_disposisi'];
	$no_agenda = $_POST['no_agenda'];
	$no_surat = $_POST['no_surat'];
	$kepada = $_POST['kepada'];
	$status_surat = $_POST['status_surat'];
	$tanggapan = $_POST['tanggapan'];

	$sql = "UPDATE disposisi SET no_agenda='$no_agenda', no_surat='$no_surat', kepada='$kepada', status_surat='$status_surat', tanggapan='$tanggapan' WHERE no_disposisi=$no_edit";

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