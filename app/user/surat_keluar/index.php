<?php  
session_start();
// Cek Login
if(empty($_SESSION['user']))
{
	echo "<script>alert('Kamu belum login wah..')</script>";
	echo "<script>window.location='../../login.php'</script>";
} else {
	// Cek akses
	if($_SESSION['akses'] != 'biasa')
	{
		echo "<script>alert('Kamu bukan Petugas!')</script>";
		echo "<script>window.location='../admin/index.php'</script>";
	} elseif($_SESSION['akses'] === NULL) {
		echo "<script>alert('Gak ada hak akses yang sesuai!')</script>";
		echo "<script>window.location='../../login.php'</script>";
		session_destroy();
	}
}

include '../layouts/header-kel.php';
include '../../system/koneksi.php';
?>

	<div class="w3-container w3-padding-bottom" style="padding-top: 22px">
		<h2><b>Data Surat Keluar</b></h2>
		<div class="w3-container-padding">
			<div class="w3-third">
				<a class="w3-btn w3-teal" href="i_keluar.php"><i class="fa fa-plus"></i> Tulis Surat Keluar</a>
			</div>

			<div class="w3-third">
				<button class="w3-btn w3-blue" onclick="window.print()"><i class="fa fa-print"></i> Report</button>
			</div>

			<div class="w3-third">
				<form method="POST">
					<?php 
						$r = @$_POST['cari'];
						if(isset($r)){
							$rc = "$r";
						}
					 ?>
					<i class="fa fa-search" style="position: absolute; margin-left: 7px; margin-top: 12px; color: silver"></i>
					<input type="search" name="cari" value="<?php if (isset($rc)) echo $rc ?>" placeholder="Cari.." style="padding-left: 30px" class="w3-input">
					<input type="submit" name="klik" style="display: none;">
					<br>
				</form>
			</div>

			<div class="w3-card-4 w3-margin-bottom">
				<table class="w3-table w3-stripped w3-bordered">
					<thead class="w3-teal">
						<tr>
							<td>No Agenda</td>
							<td>Id Petugas</td>
							<td>Jenis Surat</td>
							<td>Tanggal Terima</td>
							<td>No Surat</td>
							<td>Pengirim</td>
							<td>Perihal</td>
							<td>Aksi</td>
						</tr>
					</thead>

					<tbody>
						<?php 
						$cari = @$_POST['cari'];
						$klik = @$_POST['klik'];

						if($klik){
							$sql = "SELECT * FROM surat_keluar WHERE no_agenda LIKE '%$cari%' OR id LIKE '%$cari%' OR jenis_surat LIKE '%$cari%' OR tanggal_kirim LIKE '%$cari%' OR no_surat LIKE '%$cari%' OR pengirim LIKE '%$cari%' OR perihal LIKE '%$cari%'";
							$hasil = $konek->query($sql);
							echo "<span>Hasil cari dari : <b class='w3-text-red'>$cari</b></span>";
						}else{
							$sql = "SELECT * FROM surat_keluar";
							$hasil = $konek->query($sql);
						}

						if($hasil->num_rows > 0):
							foreach($hasil as $row):

						?>
							<tr>
								<td><?= $row['no_agenda'] ?></td>
								<td><?= $row['id'] ?></td>
								<td><?= $row['jenis_surat'] ?></td>
								<td><?= $row['tanggal_kirim'] ?></td>
								<td><?= $row['no_surat'] ?></td>
								<td><?= $row['pengirim'] ?></td>
								<td><?= $row['perihal']?></td>
								<td>
									<a class="w3-btn w3-orange w3-text-white" href="e_keluar.php?no_agenda=<?= $row['no_agenda'] ?>"><i class="fa fa-edit"></i></a>
									<a class="w3-btn w3-red" onclick="return confirm('Yakin ingin Hapus?')" href="?no_agenda=<?= $row['no_agenda'] ?>"><i class="fa fa-trash"></i></a>
								</td>
							</tr>
						<?php
							endforeach;
						else:
						?>
							<tr>
								<td colspan="6" class="w3-text-red w3-center">0 Hasil Ditemukan</td>
							</tr>
						<?php
						endif;
						?>
					</tbody>
				</table>
			</div>
		</div>

		

	</div>
	
<?php 
include '../layouts/footer.php';

if(isset($_GET['no_agenda']))
{
	$h_no = $_GET['no_agenda'];

	$sql = "DELETE FROM surat_keluar WHERE no_agenda=$h_no";
	// Jalankan query
	if($konek->query($sql))
	{
		echo "<script>alert('Data berhasil hapus!')</script>";
		echo "<script>window.location='index.php'</script>";
	} else {
		echo "<script>alert('Data gagal terhapus!')</script>";
	}
}
?>