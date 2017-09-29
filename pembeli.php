<?php require_once 'template/header.php'; ?>
<style type="text/css">
	tbody > tr > td {
		color: black;
		font-size: 16px;
	}

	thead > tr > th {
		color: black;
	}
</style>
<body>
	<div id="fh5co-page">
		<a href="#" class="js-fh5co-nav-toggle fh5co-nav-toggle"><i></i></a>
		<aside id="fh5co-aside" role="complementary" class="border js-fullheight">
			<h1 id="fh5co-logo"><a href="index.php"><img src="images/llogo.png" alt="Property Media"></a></h1>
			<nav id="fh5co-main-menu" role="navigation">
				<ul>
					<li><a href="index.php">Home</a></li>
					<li><a href="agent.php">Agent</a></li>
					<li class="fh5co-active"><a href="pembeli.php">Pembeli</a></li>
					<li><a href="about.php">Tentang</a></li>
					<li><a href="contact.php">Kontak</a></li>
				</ul>
			</nav>

			<div class="fh5co-footer">
				<p><small>Copyright &copy; PropertyMedia 2017 <?php echo date("Y") > 2017 ? " - ".date("Y") : ""; ?>.</small></p>
				<?php require_once 'template/sosial_media.php'; ?>
			</div>
		</aside>

		<div id="fh5co-main" class="container">
			<?php
					require_once 'core/db_mysqli.php';
					require_once 'core/helper.php';

					$model  = new Model_mysqli();
					$model->setTable("penjualan");

					$search = isset($_GET["search"]) ? $_GET["search"] : "";
					$page = isset($_GET["page"]) ? $_GET["page"] : 1;
			 ?>
			<div class="animate-box" data-animate-effect="fadeInLeft">
				<h2 class="fh5co-heading" style="padding-top: 50px; margin-bottom: -10px;">Data Pembeli</h2><hr>
				<div class="panel panel-primary">
					<div class="panel-body">
						<div class="row">
							<form method="get" style="margin-bottom: 55px;">
								<div class="col-md-4">
									<input type="hidden" name="page" value="1">
									<input type="text" name="search" style="color: black;" value="<?php echo $search; ?>">
									<button type="submit" class="btn btn-primary btn-outline"><i class="icon-search"></i> Cari</button>
								</div>
							</form>
						</div>
						<div class="table-responsive">
							<table class="table table-striped table-hover">
					      		<thead>
					      			<tr>
					      				<th>No</th>
					      				<th>Nama</th>
					      				<th>Nama Rumah</th>
					      				<th>Blok Rumah</th>
					      				<th>No Rumah</th>
					      				<th>Alamat</th>
					      				<th>Agent</th>
					      			</tr>
					      		</thead>
					      		<tbody>
					      			<?php 
					      				$select = array("pembeli.nama AS nama_pembeli","alamat","rumah.nama AS nama_rumah","penjualan.*","users.nama AS agent");
					      				$orderBy = array("pembeli.nama" => "ASC");
					      				$join = array(
					      								array("users","users.id = penjualan.user_id","LEFT"),
					      								array("rumah","rumah.id = penjualan.rumah_id","LEFT"),
					      								array("pembeli","pembeli.id = penjualan.pembeli_id","LEFT"),
					      							);
					      				$searchData = array(
					      									"pembeli.nama" 	=> 	$search,
					      									"alamat"		=>	$search,
					      									"rumah.nama"	=>	$search,
					      									"blok_rumah"	=>	$search,
					      									"no_rumah"		=>	$search,
					      									"users.nama"	=>	$search,
					      								);
					      				$result = $model->findDataPaging($page,10,$select,false,$orderBy,false,$join,$searchData);
										$totalPage = $model->getCountPaging(10,false,false,$join,$searchData);
					      				$no = ($page - 1) * 10;
					      				foreach ($result as $val) {
					      					$no++;
					      			?>
							      			<tr>
							      				<td><?php echo $no; ?></td>
							      				<td><?php echo $val["nama_pembeli"]; ?></td>
							      				<td><?php echo $val["nama_rumah"]; ?></td>
							      				<td align="center"><?php echo $val["blok_rumah"]; ?></td>
							      				<td align="center"><?php echo $val["no_rumah"]; ?></td>
							      				<td><?php echo $val["alamat"]; ?></td>
							      				<td><?php echo $val["agent"]; ?></td>
							      			</tr>
					      			<?php 
					      				} 

					      				if ($result == []) {
					      			?>
					      				<tr>
					      					<td colspan="7" style="color:red; font-size: 30px;" align="center" >Data tidak ada.!</td>
					      				</tr>
					      			<?php } ?>
					      		</tbody>
					      	</table>
						</div>
						<div class="animate-box" data-animate-effect="fadeInLeft">
						<!-- Paging Pembeli -->
						<?php 
							Helper::pagination($result,$totalPage,$page,$search,"Right");
						 ?>
						</div>
					</div>
				</div>
		    </div>
		</div>
	</div>
</body>
<?php require_once 'template/footer.php'; ?>
