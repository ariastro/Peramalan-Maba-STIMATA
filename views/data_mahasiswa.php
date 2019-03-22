<?php
include 'models/m_data_mahasiswa.php';
require 'models/function.php';

$mhs = new dataMahasiswa($connection);

if (@$_GET['act'] == '') {
?>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Peramalan <small>Data Jumlah Mahasiswa Baru (Trend - Least Square)</small></h1>
    </div><!-- /.col-lg-12 -->
</div><!-- /.row -->
<small>*Data Fiktif</small>
<div class="row">
	<div class="col-lg-12" style="margin-bottom: 50px;">
		<div class="table-responsive">
			<table class="table table-bordered table-hover table-striped" id="datatables">
				<thead>
					<tr bgcolor="#1ab188">
						<th style="color: white;" width="2%">No.</th>
						<th style="color: white;" width="10%">Tahun</th>
						<th style="color: white;" width="15%">Jumlah</th>
						<th style="color: white;" width="10%">X</th>
						<th style="color: white;" width="10%">XY</th>
						<th style="color: white;" width="10%">XX</th>
						<th style="color: white;" width="15%"><i class="fas fa-cogs"></i> Action</th>
					</tr>	
				</thead>

				<tbody>
					<?php
					$no = 1;
					$x = 0;
					$y = 0;
					$z = 0;
					$zz = 0;
					$jumlahX = 0;
					$jumlahXY = 0;
					$tess = 0;
					$tes =0;
					$jumlahXX = 0;
					$tampil = $mhs->tampil();
					while ($data = $tampil->fetch_object()) {
					?>
					<tr>
						<td bgcolor="#fff" align="center"><?php echo $no++ .".";?></td>
						<td bgcolor="#fff" align="center"><?php echo $data->tahun; ?></td>
						<td bgcolor="#fff" align="center"><?php echo $data->jumlah." Mahasiswa";?></td>
						<td bgcolor="#fff" align="center"><?php echo $x; ?></td>
						<?php
							$tess = $y * $data->jumlah;
							$jumlahXY += $tess;
						?>
						<td bgcolor="#fff" align="center"><?php echo $y++ * $data->jumlah; ?></td>
						<?php
							$tes = $z * $zz;
							$jumlahXX += $tes;
						?>
						<td bgcolor="#fff" align="center"><?php echo $z++ * $zz++;?></td>
						<td bgcolor="#fff" align="center">
							<a id="edit_mahasiswa" data-toggle="modal" data-target="#edit" data-id="<?php echo $data->id; ?>" data-tahun="<?php echo $data->tahun; ?>" data-jumlah="<?php echo $data->jumlah; ?>" >
								<button class="btn btn-info btn-xs"><i class="fa fa-edit"></i>Edit</button>
							</a>
							<a href="?page=data_mahasiswa&act=del&id=<?php echo $data->id ?>" onclick="return confirm ('Delete this data ?')">
							<button class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i>Delete</button>
							</a>
						</td>
					</tr>		
					<?php

						$jumlahX += $x;
						$x++;

					} 
					?>	
					<tr>
						<td bgcolor="#5bc0de" align="center" colspan=2>Jumlah</td>
						<td bgcolor="#5bc0de" align="center">
							<?php
								$hasil = $connection->conn->query("SELECT SUM(jumlah) as data FROM tb_data");
								if ($hasil->num_rows){
									while ($row = $hasil->fetch_object()){
										$jumlah[] = $row;
									}
								}
			
								foreach ($jumlah as $j) { 
									$jumlahh = $j->data;
									echo $jumlahh." Mahasiswa";
								}

								$jml_data = count(query("SELECT * FROM tb_data"));

							?>
						</td>
						<td bgcolor="#5bc0de" align="center"><?php echo $jumlahX; ?></td>
						<td bgcolor="#5bc0de" align="center"><?php echo $jumlahXY; ?></td>
						<td bgcolor="#5bc0de" align="center"><?php echo $jumlahXX; ?></td>
						<td bgcolor="#5bc0de" align="center"></td>
					</tr>
					<tr>
						<td align="center" colspan=4 bgcolor="#d43f3a" style="color: white;">a = 
							<?php  
								$a = (($jumlahh * $jumlahXX) - ($jumlahX * $jumlahXY)) / (($jml_data * $jumlahXX) - ($jumlahX * $jumlahX));
								echo $a;
							?>
						</td>
						<td align="center" colspan=3 bgcolor="#d43f3a" style="color: white;">b = 
							<?php
								$b = (($jml_data * $jumlahXY) - ($jumlahX * $jumlahh)) / (($jml_data * $jumlahXX) - ($jumlahX * $jumlahX));
								echo $b;
							?>
						</td>
					</tr>
					<tr>
						<td bgcolor="#d43f3a" style="color: white;" align="center" colspan=7>Y = <?php echo $a . " + " . $b . "X"; ?></td>
					<tr>
					<tr>
						<?php
							if(@$_POST['ramal']){
								$periode = $connection->conn->real_escape_string($_POST['periode']);
						?>
						<?php
							$tahunn = $connection->conn->query("SELECT tahun FROM tb_data ORDER BY tahun DESC LIMIT 1");
							;
						?>
						<td bgcolor="#d43f3a" style="color: white;" align="center" colspan=7> Peramalan untuk periode <?php echo $periode; ?> tahun selanjutnya (<?php echo $tahunn->fetch_assoc()["tahun"] + $periode; ?>) adalah = 

							<?php 
								$totalX = $x-1 + $periode;
								echo $a + ($b * $totalX); 
								}
							?>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
			<button type="button" class="btn btn" onclick="refresh()"><i class="fa fa-refresh"></i></button>
			<script>
				function refresh() {
				    location.reload();
				}
			</script>
			<button type="button" class="btn btn-success" data-toggle="modal" data-target="#tambah"><i class="fa fa-plus"></i> Tambah Data</button>
			<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#ramal">Forecast</button>

			<div id="tambah" class="modal fade" role="dialog">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h3 class="modal-title" align="center">Tambah Data Mahasiswa Baru</h3>
						</div>						
						<form method="post" enctype="multipart/form-data" autocomplete="off">
							<div class="modal-body">
								<div class="form-group">
									<label class="control-label" for="tahun">Tahun</label>
									<?php
										$tahun = $connection->conn->query("SELECT tahun FROM tb_data ORDER BY tahun DESC LIMIT 1");
										;
									?>
									<input type="text" name="tahun" value="<?php echo $tahun->fetch_assoc()["tahun"] + 1; ?>" class="form-control" id="tahun" readonly required>
								</div>
								<div class="form-group">
									<label class="control-label" for="nama">Jumlah</label>
									<input type="number" name="jumlah" class="form-control" id="jumlah" required autofocus>
								</div>
								<div class="modal-footer">
									<button type="reset" class="btn btn-danger">Reset</button>
									<input type="submit" class="btn btn-success" name="tambah" value="Simpan">
								</div>
							</div>
						</form>
						<?php
						if(@$_POST['tambah']){
							$tahun = $connection->conn->real_escape_string($_POST['tahun']);
							$jumlah = $connection->conn->real_escape_string($_POST['jumlah']);

							$sqlQuery = "INSERT INTO tb_data VALUES('', '$tahun', '$jumlah')";

							if(mysqli_query($connection->conn, $sqlQuery)){
								?>
									<script>
									alert('penyimpanan data berhasil');
									</script>
									<meta http-equiv="refresh" content="0; url=?page=data_mahasiswa" />
								<?php
							}
								else{
									?>
									<script>
									alert('penyimpanan data gagal');
									</script>
									<meta http-equiv="refresh" content="0; url=?page=data_mahasiswa" />
								<?php
								}
						}								
						?>
					</div>
				</div>
			</div>

			<div id="edit" class="modal fade" role="dialog">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h3 name ="editt" class="modal-title" align="center">Edit Data Mahasiswa Baru</h3>
						</div>						
						<form id="form" enctype="multipart/form-data" autocomplete="off">
							<div class="modal-body" id="modal-edit">
								<div class="form-group">
									<label class="control-label" for="tahun">Tahun</label>
									<input type="hidden" name="id" id="id">
									<input type="number" name="tahun" class="form-control" id="tahun" required autofocus>
								</div>
								<div class="form-group">
									<label class="control-label" for="jumlah">Jumlah</label>
									<input type="number" name="jumlah" class="form-control" id="jumlah" required>
								</div>
								<div class="modal-footer">
									<input type="submit" class="btn btn-success" name="edit" value="Simpan">
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>

			<div id="ramal" class="modal fade" role="dialog">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h3 class="modal-title" align="center">Ramal Jumlah Mahasiswa Baru</h3>
						</div>						
						<form method="post" enctype="multipart/form-data" autocomplete="off">
							<div class="modal-body">
								<div>
									<label class="control-label" for="periode">Periode</label><br>
									<select class="form-control" name="periode" id="periode" required>
										<option value="1">1 Tahun Selanjutnya</option>
										<option value="2">2 Tahun Selanjutnya</option>
										<option value="3">3 Tahun Selanjutnya</option>
										<option value="4">4 Tahun Selanjutnya</option>
										<option value="5">5 Tahun Selanjutnya</option>
										<option value="6">6 Tahun Selanjutnya</option>
										<option value="7">7 Tahun Selanjutnya</option>
										<option value="8">8 Tahun Selanjutnya</option>
										<option value="9">9 Tahun Selanjutnya</option>
										<option value="10">10 Tahun Selanjutnya</option>
									</select>
								</div>
								<div class="modal-footer">
									<input type="submit" class="btn btn-success" name="ramal" value="Hitung">
								</div>
							</div>
						</form>
					</div>x
				</div>
			</div>

			<script src="js/jquery-3.3.1.min.js"></script>
			<script type="text/javascript">
			$(document).on("click", "#edit_mahasiswa", function(){
					var id = $(this).data('id');
					var tahun = $(this).data('tahun');
					var jumlah = $(this).data('jumlah');
					
					$("#modal-edit #id").val(id);
					$("#modal-edit #tahun").val(tahun);
					$("#modal-edit #jumlah").val(jumlah);

			})

			$(document).ready(function(e){
				$("#form").on("submit", (function(e){
					e.preventDefault();
					$.ajax({
						url : 'models/proses_edit_mahasiswa.php',
						type : 'POST',
						data : new FormData(this),
						contentType : false,
						cache : false,
						processData : false,
						success : function(msg){
							$('.table').html(msg);
						}
					});
				}));
			});

			</script>

	</div>
</div>

<?php
}else if (@$_GET['act'] == 'del') {
	$mhs->delete($_GET['id']);
	header("location: ?page=data_mahasiswa");
}	 