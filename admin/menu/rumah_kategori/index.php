<!-- Breadcrumbs -->
<ol class="breadcrumb">
  	<li class="breadcrumb-item">
    	<a href="/property/admin/">Dashboard</a>
 	</li>
  	<li class="breadcrumb-item active">Rumah Kategori</li>
</ol>

<?php 
	$model = new Model_mysqli();
	$model->setTable("rumah_kategori");

	$orderBy = array(
			"type"	=>	"ASC",
		);
	$search = array(
			"type"	=>	isset($_GET["search"]) ? $_GET["search"] : '',
			"luas"	=>	isset($_GET["search"]) ? $_GET["search"] : '',
			"description"	=>	isset($_GET["search"]) ? $_GET["search"] : '',
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
  	<div class="card-header"><i class="fa fa-table"></i> Table Rumah kategori</div>
  	<div class="card-body ">
  		<div class="row">
		  	<div class="col-md-4">
		  		<h4 class="card-title">
		  			<?php if($admin["role"] == "super_admin") : ?>
			    	<a href="?menu=rumah_kategori/add" class="btn btn-outline-success btn-sm"><i class="fa fa-plus"></i>	Tambah Data</a>
			    	<?php endif; ?>
			    </h4>
		  	</div>
		  	<div class="col-md-8">
		  		<form method="get" class="form-inline pull-right">
					<div class="form-group">
					    <div class="input-group">
					    	<input type="hidden" name="menu" value="rumah_kategori">
					    	<input type="hidden" name="page" value="1">
						    <input type="text" name="search" value="<?php echo isset($_GET["search"]) ? $_GET["search"] : ''; ?>" class="form-control" placeholder="Cari">
						    <button type="submit" class="btn btn-outline-info btn-sm"><i class="fa fa-search"></i> Cari</button>
					    </div>
					</div>
				</form>
		  	</div>
		</div>
	    <table id="tableRumah_kategori" class="table table-striped table-bordered table-sm table-responsive" style="width:100%">
			<thead class="">
				<tr>
    				<th>No</th>
    				<th>Type</th>
					<th>Luas</th>
					<th>Description</th>
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
							<td><?php echo $item["type"]; ?></td>
							<td style="width: 25%;"><?php echo $item["luas"]; ?></td>
							<td>
								<?php echo $item["description"]; ?>
							</td>

							<?php if($admin["role"] == "super_admin") : ?>
							<td style="width: 18%;">
								<a href="?menu=rumah_kategori/update/<?php echo $item["id"].$redirect; ?>" class="btn btn-outline-warning btn-sm"><i class="fa fa-edit"></i> Edit</a> &nbsp; &nbsp;
								<a href="?menu=rumah_kategori&delete=<?php echo $item["id"].$redirect; ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('Apakah anda yakin ingin menghapus data ini.?')"><i class="fa fa-trash-o"></i> Hapus</a>
							</td>
							<?php endif; ?>
						</tr>
				<?php 
					endforeach; 

					if($result == []) :
				?>
					<tr><td colspan="5" align="center" class="text-danger"><b><i>Data tidak di temukan..</i></b></td></tr>
				<?php 
					endif;
				?>
			</tbody>
		</table>
		<?php 
			/* For Pagination */
			Helper::pagination($result,$total_pages,"rumah_kategori",$page,"left");
		?>
  	</div>
</div>