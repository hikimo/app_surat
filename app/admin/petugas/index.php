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
?>

	<div class="w3-container w3-padding-bottom" style="padding-top: 22px">
		<h2><b>Data Petugas</b></h2>
		<div class="w3-container-padding">
			<div class="w3-third">
				<a class="w3-btn w3-teal" href="i_petugas.php"><i class="fa fa-plus"></i> Tambah Petugas</a>
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
							<td>No</td>
							<td>Useraname</td>
							<td>Nama Depan</td>
							<td>Nama Belakang</td>
							<td>Hak</td>
							<td>Aksi</td>
						</tr>
					</thead>

					<tbody>
						<?php 
						$cari = @$_POST['cari'];
						$klik = @$_POST['klik'];

						if($klik){
							$sql = "SELECT * FROM petugas WHERE nama_depan LIKE '%$cari%' OR nama_belakang LIKE '%$cari%' OR hak LIKE '%$cari%' OR username LIKE '%$cari%' OR id LIKE '%$cari%'";
							$hasil = $konek->query($sql);
							echo "<span>Hasil cari dari : <b class='w3-text-red'>$cari</b></span>";
						}else{
							$sql = "SELECT * FROM petugas";
							$hasil = $konek->query($sql);
						}

						$no = 0;
						if($hasil->num_rows > 0):
							foreach($hasil as $row):

						?>
							<tr>
								<td><?= ++$no ?></td>
								<td><?= $row['username'] ?></td>
								<td><?= $row['nama_depan'] ?></td>
								<td><?= $row['nama_belakang'] ?></td>
								<td><?= $row['hak'] ?></td>
								<td>
									<a class="w3-btn w3-orange w3-text-white" href="e_petugas.php?id=<?= $row['id'] ?>"><i class="fa fa-edit"></i></a>
									<a class="w3-btn w3-red" href="?id=<?= $row['id'] ?>"><i class="fa fa-trash"></i></a>
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

if(isset($_GET['id']))
{
	$h_id = $_GET['id'];

	$sql = "DELETE FROM petugas WHERE id=$h_id";
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