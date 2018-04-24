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

include 'layouts/header-index.php';
include '../system/koneksi.php';
?>

	<div class="w3-container" style="padding-top: 22px">
		<h5><b><i class="fa fa-user"></i> Dashboard Admin</b></h5>
	</div>

	<div class="w3-row-padding w3-margin-bottom">

		<div class="w3-quarter">
			<div class="w3-container w3-teal w3-padding-16">
				<div class="w3-left"><i class="fa fa-users w3-xxxlarge"></i></div>
				<div class="w3-right">
					<?php 
					$q_pet = "SELECT * FROM petugas";
					$j_pet = $konek->query($q_pet);
					?>
					<h3><?= $j_pet->num_rows ?></h3>
				</div>
				<div class="w3-clear"></div>
				<h4>Petugas</h4>
			</div>
		</div>

		<div class="w3-quarter">
			<div class="w3-container w3-red w3-padding-16">
				<div class="w3-left"><i class="fa fa-envelope w3-xxxlarge"></i></div>
				<div class="w3-right">
					<?php 
					$q_mas = "SELECT * FROM surat_masuk";
					$j_mas = $konek->query($q_mas);
					?>
					<h3><?= $j_mas->num_rows ?></h3>
				</div>
				<div class="w3-clear"></div>
				<h4>Surat Masuk</h4>
			</div>
		</div>

		<div class="w3-quarter">
			<div class="w3-container w3-blue w3-padding-16">
				<div class="w3-left"><i class="fa fa-envelope-open w3-xxxlarge"></i></div>
				<div class="w3-right">
					<?php 
					$q_kel = "SELECT * FROM surat_keluar";
					$j_kel = $konek->query($q_kel);
					?>
					<h3><?= $j_kel->num_rows ?></h3>
				</div>
				<div class="w3-clear"></div>
				<h4>Surat Keluar</h4>
			</div>
		</div>		

		<div class="w3-quarter">
			<div class="w3-container w3-black w3-padding-16">
				<div class="w3-left"><i class="fa fa-check w3-xxxlarge"></i></div>
				<div class="w3-right">
					<?php 
					$q_dis = "SELECT * FROM disposisi";
					$j_dis = $konek->query($q_dis);
					?>
					<h3><?= $j_dis->num_rows ?></h3>
				</div>
				<div class="w3-clear"></div>
				<h4>Disposisi</h4>
			</div>
		</div>
	</div>

<?php 
include 'layouts/footer.php';
?>