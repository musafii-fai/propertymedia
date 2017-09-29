<!-- Breadcrumbs -->
<ol class="breadcrumb">
  	<li class="breadcrumb-item">
    	<a href="/property/admin/">Dashboard</a>
 	</li>
  	<li class="breadcrumb-item active">Pembeli</li>
</ol>

<?php 
	$model = new Model_mysqli();
	$model->setTable("pembeli");

	$page = isset($_GET["page"]) ? $_GET["page"] : 1;
	$select = array( "pembeli.*","users.nama AS admin" );
	$orderBy = array(
			"tanggal_input"	=>	"DESC",
		);
	$search = array(
			"users.nama"	=>	isset($_GET["search"]) ? $_GET["search"] : '',
			"tanggal_input"	=>	isset($_GET["search"]) ? $_GET["search"] : '',
			"pembeli.nama"	=>	isset($_GET["search"]) ? $_GET["search"] : '',
			"jenis_kelamin"	=>	isset($_GET["search"]) ? $_GET["search"] : '',
			"umur"			=>	isset($_GET["search"]) ? $_GET["search"] : '',
			"alamat"		=>	isset($_GET["search"]) ? $_GET["search"] : '',
			"pekerjaan"		=>	isset($_GET["search"]) ? $_GET["search"] : '',
		);
	$join = array(
				array("users","users.id = pembeli.user_id","LEFT")
			);
	$result = $model->findDataPaging($page,10,$select,false,$orderBy,$search,$join);
	$total_pages = $model->getCountPaging(10,false,$search,$join);	// for pagination
?>

<div class="card border-info">
  	<div class="card-header"><i class="fa fa-table"></i> Table Pembeli</div>
  	<div class="card-body ">
	  	
  		<form method="get" class="form-inline pull-right">
			<div class="form-group">
			    <div class="input-group">
			    	<input type="hidden" name="menu" value="pembeli">
			    	<input type="hidden" name="page" value="1">
				    <input type="text" name="search" value="<?php echo isset($_GET["search"]) ? $_GET["search"] : ''; ?>" class="form-control" placeholder="Cari">
				    <button type="submit" class="btn btn-outline-info btn-sm"><i class="fa fa-search"></i> Cari</button>
			    </div>
			</div>
		</form>
	  	<br><br>
	    <table id="tablepembeli" class="table table-striped table-bordered table-sm table-responsive" style="width:100%">
			<thead class="">
				<tr>
    				<th>No</th>
    				<th>Admin</th>
					<th>Tanggal Input</th>
					<th>Nama</th>
					<th>Jenis Kelamin</th>
					<th>Umur</th>
					<th>Pekerjaan</th>
					<th>Alamat</th>
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
							<td style="width: 17%;"><?php echo $item["tanggal_input"]; ?></td>
							<td style="width: 18%;"><?php echo $item["nama"]; ?></td>
							<td><?php echo $item["jenis_kelamin"]; ?></td>
							<td><?php echo $item["umur"]; ?></td>
							<td style="width: 18%;"><?php echo $item["pekerjaan"]; ?></td>
							<td><?php echo $item["alamat"]; ?></td>

							<td>
								<?php if($item["user_id"] == $admin["id"] || $admin["role"] == "super_admin") : ?>
									<a href="?menu=pembeli/update/<?php echo $item["id"].$redirect; ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Edit</a> &nbsp; &nbsp;
								<?php endif; ?>
							</td>
						</tr>
				<?php 
					endforeach; 

					if($result == []) :
				?>
					<tr><td colspan="9" align="center" class="text-danger"><b><i>Data tidak di temukan..</i></b></td></tr>
				<?php 
					endif;
				?>
			</tbody>
		</table>
		<?php 
			/* For Pagination */
			Helper::pagination($result,$total_pages,"pembeli",$page,"left");
		?>
  	</div>
</div>