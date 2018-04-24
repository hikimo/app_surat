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

include '../layouts/header-dis.php';
include '../../system/koneksi.php';
?>

	<div class="w3-container w3-padding-bottom" style="padding-top: 22px">
		<div class="w3-card-4">
			<div class="w3-container w3-teal">
				<h2>Buat Disposisi</h2>
			</div>

			<div class="w3-container">
				<form method="POST">

					<p>
						<label class="w3-label" for="no_agenda">No Agenda</label>
						<select name="no_agenda" class="w3-select">
							<?php  
							$q_no = "SELECT no_agenda FROM surat_masuk";
							$h_no = $konek->query($q_no);
							
							if($h_no->num_rows > 0):
								foreach($h_no as $t_no):
							?>
								<option value="<?= $t_no['no_agenda'] ?>"><?= $t_no['no_agenda']?></option>
							<?php  
								endforeach;
							else:
							?>
								<script type="text/javascript">
									alert('Belum ada surat masuk untuk di disposisikan');
									window.location='index.php';
								</script>
							<?php
							endif;
							?>
						</select>
					</p>

					<p>
						<label class="w3-label" for="no_surat">Nomor Surat</label>
						<input type="number" name="no_surat" class="w3-input" id="no_surat" required>
					</p>

					<p>
						<label class="w3-label" for="kepada">Kepada</label>
						<input type="text" name="kepada" class="w3-input" id="kepada" required>
					</p>

					<p>
						<label class="w3-label" for="keterangan">Keterangan</label>
						<input type="text" name="keterangan" class="w3-input" id="keterangan" required>
					</p>

					<p>
						<label class="w3-label" for="status_surat">Status Surat</label>
						<input type="status_surat" name="status_surat" class="w3-input" id="status_surat" required>
					</p>

					<p>
						<label class="w3-label" for="tanggapan">Tanggapan</label>
						<input type="tanggapan" name="tanggapan" class="w3-input" id="tanggapan" required>
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
	$no_agenda = $_POST['no_agenda'];
	$no_surat = $_POST['no_surat'];
	$kepada = $_POST['kepada'];
	$keterangan = $_POST['keterangan'];
	$status_surat = $_POST['status_surat'];
	$tanggapan = $_POST['tanggapan'];

	$sql = "INSERT INTO disposisi(no_agenda,no_surat,kepada,keterangan,status_surat,tanggapan) VALUES('$no_agenda','$no_surat','$kepada','$keterangan','$status_surat', '$tanggapan')";

	// Mari jalankan query
	if($konek->query($sql) === TRUE)
	{
		echo "<script>alert('Data berhasil masuk gan! :D')</script>";
		echo "<script>window.location='index.php'</script>";
	} else {
		echo "<script>alert('Data gagal masuk/No agenda telah dipakai')</script>";
	}
}
?>