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

include '../layouts/header-kel.php';
include '../../system/koneksi.php';

if(isset($_GET['no_agenda']))
{
	$g_no = $_GET['no_agenda'];
	$q_e = "SELECT * FROM surat_keluar WHERE no_agenda=$g_no";
	$hasil = $konek->query($q_e);
	$hasil = $hasil->fetch_assoc();
}
?>

	<div class="w3-container w3-padding-bottom" style="padding-top: 22px">
		<div class="w3-card-4">
			<div class="w3-container w3-teal">
				<h2>Ubah Surat Keluar</h2>
			</div>

			<div class="w3-container">
				<form method="POST">

					<p>
						<label class="w3-label" for="jenis_surat">Jenis Surat</label>
						<input type="text" name="jenis_surat" value="<?= $hasil['jenis_surat']?>" class="w3-input" id="jenis_surat" required>
					</p>

					<p>
						<label class="w3-label" for="tanggal_kirim">Tanggal Kirim</label>
						<input type="date" name="tanggal_kirim" value="<?= $hasil['tanggal_kirim']?>" class="w3-input" id="tanggal_kirim" required>
					</p>

					<p>
						<label class="w3-label" for="no_surat">No Surat</label>
						<input type="number" name="no_surat" value="<?= $hasil['no_surat']?>" class="w3-input" id="status_surat" required>
					</p>

					<p>
						<label class="w3-label" for="pengirim">Pengirim</label>
						<input type="text" name="pengirim" value="<?= $hasil['pengirim']?>" class="w3-input" id="pengirim" required>
					</p>

					<p>
						<label class="w3-label" for="perihal">Perihal</label>
						<input type="text" name="perihal" value="<?= $hasil['perihal']?>" class="w3-input" id="perihal" required>
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

	$g_u = $_SESSION['user'];
	$q_u = "SELECT id FROM petugas WHERE username='$g_u'";
	if($konek->query($q_u)){
		$hasil = $konek->query($q_u);
		$hasil = $hasil->fetch_assoc(); 
	}

	$id = $hasil['id'];
	$jenis_surat = $_POST['jenis_surat'];
	$tanggal_kirim = $_POST['tanggal_kirim'];
	$no_surat = $_POST['no_surat'];
	$pengirim = $_POST['pengirim'];
	$perihal = $_POST['perihal'];

	$sql = "UPDATE surat_keluar SET id='$id', jenis_surat='$jenis_surat', tanggal_kirim='$tanggal_kirim', no_surat='$no_surat', pengirim='$pengirim', perihal='$perihal' WHERE no_agenda=$g_no";

	// Mari jalankan query
	if($konek->query($sql) === TRUE)
	{
		echo "<script>alert('Data Berubah! :D')</script>";
		echo "<script>window.location='index.php'</script>";
	} else {
		echo "<script>alert('Data gagal berubah!')</script>";
	}
}
?>