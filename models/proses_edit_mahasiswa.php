<?php
ob_start();
require_once('../config/+koneksi.php');
require_once('../models/database.php');
include '../models/m_data_mahasiswa.php';

$connection = new Database($host, $user, $pass, $database);
$mhs = new dataMahasiswa($connection);

$id = $_POST['id'];
$tahun = $connection->conn->real_escape_string($_POST['tahun']);
$jumlah = $connection->conn->real_escape_string($_POST['jumlah']);

$sqlQuery = "UPDATE tb_data SET tahun = '$tahun', jumlah = '$jumlah' WHERE id = '$id'";

if(mysqli_query($connection->conn, $sqlQuery)){
	?>
		<script>
		alert('Update data berhasil');
		</script>
		<meta http-equiv="refresh" content="0; url=?page=data_mahasiswa" />
	<?php
	}
	else{
		?>
		<script>
		alert('Update data gagal');
		</script>
		<meta http-equiv="refresh" content="0; url=?page=data_mahasiswa" />
		<?php
	}
?>