<!-- Breadcrumbs -->
<ol class="breadcrumb">
  	<li class="breadcrumb-item">
    	<a href="/property/admin/">Dashboard</a>
 	</li>
  	<li class="breadcrumb-item active">Transaksi Penjualan</li>
</ol>

<?php 
	$model = new Model_mysqli();
	$model->setTable("penjualan");

	$page = isset($_GET["page"]) ? $_GET["page"] : 1;
	$select = array( "penjualan.*","users.nama AS admin","rumah.nama AS nama_rumah","pembeli.nama AS nama_pembeli" );
	$orderBy = array(
			"penjualan.tanggal_input"	=>	"DESC",
		);
	$search = array(
			"users.nama"	=>	isset($_GET["search"]) ? $_GET["search"] : '',
			"penjualan.tanggal_input"	=>	isset($_GET["search"]) ? $_GET["search"] : '',
			"rumah.nama"	=>	isset($_GET["search"]) ? $_GET["search"] : '',
			"pembeli.nama"	=>	isset($_GET["search"]) ? $_GET["search"] : '',
			"blok_rumah"	=>	isset($_GET["search"]) ? $_GET["search"] : '',
			"no_rumah"		=>	isset($_GET["search"]) ? $_GET["search"] : '',
		);
	$join = array(
				array("users","users.id = penjualan.user_id","LEFT"),
				array("rumah","rumah.id = penjualan.rumah_id","LEFT"),
				array("pembeli","pembeli.id = penjualan.pembeli_id","LEFT")
			);
	$result = $model->findDataPaging($page,10,$select,false,$orderBy,$search,$join);
	$total_pages = $model->getCountPaging(10,false,$search,$join);	// for pagination

	/* for delete */
	if (isset($_GET["delete"])) {
		$idDelete = $_GET["delete"];
		$getById = $model->getById($idDelete);
		if (($admin["role"] == "admin" && $admin["id"] != $getById["user_id"]) || $admin == null) {
	        echo "<script> window.location.href = '?menu=penjualan'; </script>";
	    } else {
	    	$hapus = $model->delete($idDelete);
			if ($hapus) {
				$model->delete($getById["pembeli_id"],"pembeli");
				echo "<script> document.location.href = '".$backRedirect."'; </script>";
			}
	    }
	}
?>

<div class="card border-primary">
  	<div class="card-header"><i class="fa fa-table"></i> Table Transaksi Penjualan</div>
  	<div class="card-body ">
	  	
  		<form method="get" class="form-inline pull-right">
			<div class="form-group">
			    <div class="input-group">
			    	<input type="hidden" name="menu" value="penjualan">
			    	<input type="hidden" name="page" value="1">
				    <input type="text" name="search" value="<?php echo isset($_GET["search"]) ? $_GET["search"] : ''; ?>" class="form-control" placeholder="Cari">
				    <button type="submit" class="btn btn-outline-info btn-sm"><i class="fa fa-search"></i> Cari</button>
			    </div>
			</div>
		</form>
	  	<br><br>
	    <table id="tablepenjualan" class="table table-striped table-bordered table-sm table-responsive" style="width:100%">
			<thead class="">
				<tr>
    				<th>No</th>
    				<th>Admin</th>
					<th>Tanggal Input</th>
					<th>Nama Rumah</th>
					<th>Nama Pembeli</th>
					<th>Blok</th>
					<th>No_rumah</th>
    				<th>Action</th>
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
							<td><?php echo $item["admin"]; ?></td>
							<td><?php echo $item["tanggal_input"]; ?></td>
							<td><?php echo $item["nama_rumah"]; ?></td>
							<td><?php echo $item["nama_pembeli"]; ?></td>
							<td><?php echo $item["blok_rumah"]; ?></td>
							<td><?php echo $item["no_rumah"]; ?></td>

							<td>
								<?php if($admin["role"] == "super_admin" || $admin["id"] == $item["user_id"]) : ?>
									<a href="?menu=penjualan&delete=<?php echo $item["id"].$redirect; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin ingin menghapus data ini.?')"><i class="fa fa-trash-o"></i> Hapus</a>
								<?php endif; ?>
							</td>
						</tr>
				<?php 
					endforeach; 

					if($result == []) :
				?>
					<tr><td colspan="8" align="center" class="text-danger"><b><i>Data tidak di temukan..</i></b></td></tr>
				<?php 
					endif;
				?>
			</tbody>
		</table>
		<?php 
			/* For Pagination */
			Helper::pagination($result,$total_pages,"penjualan",$page,"left");
		?>
  	</div>
</div>