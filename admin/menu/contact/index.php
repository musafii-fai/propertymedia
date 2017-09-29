<!-- Breadcrumbs -->
<ol class="breadcrumb">
  	<li class="breadcrumb-item">
    	<a href="/property/admin/">Dashboard</a>
 	</li>
  	<li class="breadcrumb-item active">Settings Contact</li>
</ol>

<?php 
	$modelAbout = new Model_mysqli();
	$modelAbout->setTable("info_about");


	if (isset($_POST["btnSimpanContact"])) {
		$email = $_POST["email"];
		$noTelp = $_POST["no_telp"];
		$alamat = $_POST["alamat"];

		if (!empty(trim($email)) && !empty(trim($noTelp)) && !empty(trim($alamat)) ) {
			$data = array(
							"email" 	=> 	$email,
							"no_telp"	=>	$noTelp,
							"alamat"	=>	$alamat,
						);
			$updateAbout = $modelAbout->update(1,$data);
            if($updateAbout){
                echo "<script> alert('Data berhasil di simpan'); </script>";
                echo "<script> document.location.href = '?menu=contact'; </script>";
            }      
		} else {
			$errorFormData = Helper::spanDanger("Email, No Telp, atau Alamat tidak boleh kosong..!");
            $errorFormData .=  "<br><br>";
		}
	}

	$getByIdAbout = $modelAbout->getById(1);
?>

<div class="card border-primary">
	<form action="" method="POST">
		<div class="card-header">
			<div class="row">
				<div class="col-md-4">
					<button type="submit" name="btnSimpanContact" class="btn btn-primary">Update Contact Info <i class="fa fa-hand-o-up"></i></button>
				</div>
				<div class="col-md-8">
					<?php echo isset($errorFormData) ? $errorFormData : ""; ?>		
				</div>
			</div>
		</div>
		<div class="card-body">
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label>Email</label>
						<input type="email" name="email" class="form-control" value="<?php echo $getByIdAbout["email"]; ?>" placeholder="Email" required>
					</div>
					<div class="form-group">
						<label>No Telp</label>
						<input type="text" name="no_telp" class="form-control" value="<?php echo $getByIdAbout["no_telp"]; ?>" required placeholder="No Telp" >
					</div>
				</div>
				<div class="col-md-8">
					<div class="form-group">
						<label>Alamat</label>
						<textarea name="alamat" rows="5" placeholder="Alamat" class="form-control"><?php echo $getByIdAbout["alamat"]; ?></textarea>
					</div>			
				</div>
			</div>
		</div>
	</form>
</div>
<br>

<?php 
	$model = new Model_mysqli();
	$model->setTable("contact");

	$orderBy = array(
			"tanggal_input"	=>	"DESC",
		);
	$search = array(
			"nama"	=>	isset($_GET["search"]) ? $_GET["search"] : '',
			"email"	=>	isset($_GET["search"]) ? $_GET["search"] : '',
			"phone"	=>	isset($_GET["search"]) ? $_GET["search"] : '',
			"message"	=>	isset($_GET["search"]) ? $_GET["search"] : '',
		);
	$page = isset($_GET["page"]) ? $_GET["page"] : 1;

	$result = $model->findDataPaging($page,10,false,false,$orderBy,$search);
	$total_pages = $model->getCountPaging(10,false,$search);	// for pagination

	/* for delete */
	if (isset($_GET["delete"])) {
		if ($admin == null) {
			echo "<script> document.location.href = '".$backRedirect."'; </script>";
		} else {
			$idDelete = $_GET["delete"];
			$hapus = $model->delete($idDelete);
			if ($hapus) {
				echo "<script> document.location.href = '".$backRedirect."'; </script>";
			}
		}
	}
?>

<div class="card border-warning ">
  	<div class="card-header"><i class="fa fa-table"></i> Table Contact</div>
  	<div class="card-body ">
  		<div class="row">
		  	<div class="col-md-12">
		  		<form method="get" class="form-inline pull-right">
					<div class="form-group">
					    <div class="input-group">
					    	<input type="hidden" name="menu" value="contact">
					    	<input type="hidden" name="page" value="1">
						    <input type="text" name="search" value="<?php echo isset($_GET["search"]) ? $_GET["search"] : ''; ?>" class="form-control" placeholder="Cari">
						    <button type="submit" class="btn btn-outline-info btn-sm"><i class="fa fa-search"></i> Cari</button>
					    </div>
					</div>
				</form>
		  	</div>
		</div>
	    <table id="tablecontact" class="table table-striped table-bordered table-sm table-responsive" style="width:100%">
			<thead class="">
				<tr>
    				<th>No</th>
    				<th>Tanggal</th>
    				<th>Nama</th>
    				<th>Email</th>
					<th>Phone</th>
					<th>Message</th>
    				<?php if($admin["role"] == "super_admin") : ?>
    				<th>Action</th>
    				<?php endif; ?>
				</tr>
			</thead>
			<tbody>
				<?php 
					$no = ($page - 1) * 10;
					foreach($result as $item) : 
						$no++;
				?>
						<tr>
							<td><?php echo $no; ?></td>
							<td><?php echo $item["tanggal_input"]; ?></td>
							<td><?php echo $item["nama"]; ?></td>
							<td><?php echo $item["email"]; ?></td>
							<td><?php echo $item["phone"]; ?></td>
							<td><?php echo $item["message"]; ?></td>

							<?php if($admin["role"] == "super_admin") : ?>
							<td>
								<a href="?menu=contact&delete=<?php echo $item["id"].$redirect; ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('Apakah anda yakin ingin menghapus data ini.?')"><i class="fa fa-trash-o"></i> Hapus</a>
							</td>
							<?php endif; ?>
						</tr>
				<?php 
					endforeach; 

					if($result == []) :
				?>
					<tr><td colspan="7" align="center" class="text-danger"><b><i>Data tidak di temukan..</i></b></td></tr>
				<?php 
					endif;
				?>
			</tbody>
		</table>
		<?php 
			/* For Pagination */
			Helper::pagination($result,$total_pages,"contact",$page,"left");
		?>
  	</div>
</div>

