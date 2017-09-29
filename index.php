<?php require_once 'template/header.php'; ?>
<body>
	<div id="fh5co-page">
		<a href="#" class="js-fh5co-nav-toggle fh5co-nav-toggle"><i></i></a>
		<aside id="fh5co-aside" role="complementary" class="border js-fullheight">
			<h1 id="fh5co-logo"><a href="index.php"><img src="images/llogo.png" alt="Property Media"></a></h1>
			<nav id="fh5co-main-menu" role="navigation">
				<ul>
					<li class="fh5co-active"><a href="index.php">Home</a></li>
					<li><a href="agent.php">Agent</a></li>
					<li><a href="pembeli.php">Pembeli</a></li>
					<li><a href="about.php">Tentang</a></li>
					<li><a href="contact.php">Kontak</a></li>
				</ul>
			</nav>

			<div class="fh5co-footer">
				<p><small>Copyright &copy; PropertyMedia 2017 <?php echo date("Y") > 2017 ? " - ".date("Y") : ""; ?>.</small></p>
				<?php require_once 'template/sosial_media.php'; ?>
			</div>
		</aside>

		<div id="fh5co-main">
			<?php
					require_once 'core/db_mysqli.php';
					require_once 'core/helper.php';

					$modelRumah  = new Model_mysqli();
					$modelRumah->setTable("rumah");
					$modelType = new Model_mysqli();
					$modelType->setTable("rumah_kategori");

					$search = isset($_GET["search"]) ? $_GET["search"] : "";
					$type = isset($_GET["type"]) ? $_GET["type"] : "";
					$harga = isset($_GET["harga"]) ? $_GET["harga"] : "";
					$page = isset($_GET["page"]) ? $_GET["page"] : 1;
			 ?>
			<div class="fh5co-narrow-content">
					<div class="fh5co-heading animate-box" data-animate-effect="fadeInLeft">
						<h1>Home</h1>
						<hr>
						<form class="" action="" method="get">
							<div class="form-group">
								<input type="hidden" name="page" value="1">
								<input type="text" name="search" value="<?php echo $search; ?>" placeholder="Pencarian" class="form-control">
								<div class="row">
									<div class="col-md-4">
										<select class="form-control" name="type" style="margin-top:10px;">
											<option value="">Type</option>
											<?php 
												$resultType = $modelType->findData(false,false,array("type" => "ASC"));
												foreach ($resultType as $val) :
											?>
												<option value="<?php echo $val["type"]; ?>" <?php echo $type == $val["type"] ? "selected" : ""; ?>><?php echo $val["type"]; ?></option>
											<?php endforeach; ?>
										</select>
									</div>
									<div class="col-md-4">
										<select class="form-control" name="harga" style="margin-top:10px;">
											<option value="">Harga</option>
											<?php 
												$resultFilterRumah = $modelRumah->findData(false,false,array("harga" => "ASC"),false,false,false,false,array("harga"));
												foreach ($resultFilterRumah as $val) :
											?>
											<option value="<?php echo $val["harga"] ?>" <?php echo $harga == $val["harga"] ? "selected" : ""; ?>><?php echo "Rp.".number_format($val["harga"],0,",","."); ?></option>
											<?php endforeach; ?>
										</select>
									</div>
									<div class="col-md-4">
										<button type="submit" class="btn btn-primary btn-outline btn-lg"><i class="icon-search"></i> Cari Sekarang</button>
									</div>
								</div>
							</div>
						</form>
						<hr>
					</div>
					<!-- Product Rumah -->
					<div class="row animate-box" data-animate-effect="fadeInLeft">
						<?php
								$pageRedirect = isset($_GET["page"]) ? "?page=".$page."&search=".$search."&type=".$type."&harga=".$harga : "";
								$page = isset($_GET["page"]) ? $page : 1;
								$searchPage = isset($_GET["search"]) ? $pageRedirect : "?page=".$page;

								$select = array("rumah.*","type");
								$orderBy = array("nama" => "ASC");
								// $orderBy = false;
								$searchRumah = array(
														"nama" 	=> 	$search,
														"type"	=>	$type,
														"harga"	=>	$harga,
													);
								$join = array(
												array("rumah_kategori","rumah_kategori.id = rumah.kategori_id"),
											);
								$resultProdukRumah = $modelRumah->findDataPaging($page,6,$select,false,$orderBy,$searchRumah,$join);
								$totalPageRumah = $modelRumah->getCountPaging(6,false,$searchRumah,$join);
								// shuffle($resultProdukRumah);
						?>
						<?php foreach ($resultProdukRumah AS $val) { ?>
							<div class="col-md-4 col-sm-6 col-xs-6 col-xxs-12 work-item">
								<div class="thumbnail">
									<center>
									<a href="detail.php<?php echo $searchPage."&detail=".$val["id"]; ?>">
										<?php 
											$srcImg = $val["photo"] == "" ? "/admin/img/omah_omahan.png" : "/admin/upload/rumah/".$val['photo'];
										?>
										<img src="<?php echo $srcImg; ?>" alt="<?php echo $val["nama"]; ?>" style="width:250px; height:220px;" class="img-responsive">
										<h3 class="fh5co-work-title"><?php echo $val["nama"]; ?></h3>
										<span>Type: <?php echo $val["type"]; ?></span><br>
										<span>Harga: <?php echo "Rp.".number_format($val["harga"],0,",","."); ?></span>
									</a>
								</center>
								</div>
							</div>
						<?php } ?>
						<?php if($resultProdukRumah == []) : ?>
							<center>
								<div class="animate-box" data-animate-effect="fadeInLeft">
									<h1 class="fh5co-heading-colored">Rumah tidak ada.!</h1>
								</div>
							</center>
						<?php endif; ?>
					</div>

					<div class="animate-box" data-animate-effect="fadeInLeft">
					<!-- Paging Product Rumah -->
					<?php 
						$pageSearch = isset($_GET["search"]) ? "&search=".$search."&type=".$type."&harga=".$harga : "";
						Helper::pagination($resultProdukRumah,$totalPageRumah,$page,$pageSearch,"Right");
					 ?>
					</div>
			</div>
		</div>
	</div>
</body>
<?php require_once 'template/footer.php'; ?>
