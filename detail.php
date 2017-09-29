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
		    <div class="fh5co-narrow-content">
		      <div class="row">
		        <div class="col-md-5">
		        	<?php 
		        		require_once 'core/db_mysqli.php';
						require_once 'core/helper.php';

						$modelRumah  = new Model_mysqli();
						$modelRumah->setTable("rumah");
						$modelKategori = new Model_mysqli();
						$modelKategori->setTable("rumah_kategori");
						$modelBlok = new Model_mysqli();
						$modelBlok->setTable("rumah_blok");
						$modelPenjualan = new Model_mysqli();
						$modelPenjualan->setTable("penjualan");

		          		$detail = isset($_GET["detail"]) ? $_GET["detail"] : "";

		          		$getByIdRumah = $modelRumah->getById($detail);
		          		$getByIdType = $modelKategori->getById($getByIdRumah["kategori_id"]);

		        	?>
		        	<?php if($getByIdRumah == NULL) : ?>
		        	<div class="animate-box" data-animate-effect="fadeInLeft">
						<h1 class="fh5co-heading-colored">Rumah tidak ada.!</h1>
					</div>
					<?php endif; ?>
		          	<h2 class="fh5co-heading animate-box" data-animate-effect="fadeInLeft"><?php echo $getByIdRumah["nama"]; ?></h2>
		          	<p class="fh5co-lead animate-box" data-animate-effect="fadeInLeft">
		          		Type: <?php echo $getByIdType["type"]; ?>
		          		<br>
		          		Harga: Rp.<?php echo number_format($getByIdRumah["harga"],0,",","."); ?>
		          	</p>
		          	<p class="animate-box" data-animate-effect="fadeInLeft">
			            <table class="table">
			                <thead>
				                <tr>
				                   <th>Blok Rumah</th>
				                   <th>Jumlah Rumah</th>
				                   <th>Rumah Terjual</th>
				                   <th>Rumah Tersediah</th>
				                </tr>
			                </thead>
			                <tbody>
			                	<?php 
			                		$where = array("rumah_id" => $getByIdRumah["id"]);
			                		$orderBy = array("blok" => "ASC");
			                		$resultBlok = $modelBlok->findData(false,$where,$orderBy);
			                		$totalRumah = null;
			                		$totalRumahTerjual = null;
			                		$totalRumahTersediah = null;
			                		foreach ($resultBlok as $val) :
										$totalRumah += intval($val["jumlah"]);
										$blokPenjualan = array(
															"rumah_id" => $val["rumah_id"],
															"blok_rumah" => $val["blok"],
														);
										$rumahTerjual = $modelPenjualan->getCount($blokPenjualan);
										$totalRumahTerjual += intval($rumahTerjual);
										$totalRumahTersediah += $val["jumlah"] - $rumahTerjual;
			                	?>
				                <tr>
				                   <td><?php echo $val["blok"]; ?></td>
				                   <td><?php echo $val["jumlah"]; ?></td>
				                   <td><?php echo $rumahTerjual; ?></td>
				                   <td><?php echo $val["jumlah"] - $rumahTerjual; ?></td>
				                </tr>
				            	<?php endforeach; ?>
			                </tbody>
			                <tfoot>
			                  <tr>
			                    <th>Total</th>
			                    <th><?php echo $totalRumah; ?></th>
			                    <th><?php echo $totalRumahTerjual; ?></th>
			                    <th><?php echo $totalRumahTersediah; ?></th>
			                  </tr>
			                </tfoot>
			            </table>
		         	</p>
		          <p class="fh5co-lead animate-box" data-animate-effect="fadeInLeft">Lokasi: <?php echo $getByIdRumah["lokasi"]; ?></p>
		          <?php
			            $backRedirect =  $_SERVER["REQUEST_URI"];
			            $backRedirect = str_replace("detail.php","index.php",$backRedirect);
			            $backRedirect = str_replace("&detail=".$detail,"", $backRedirect);
			            // echo $backRedirect;
		          ?>
		          <p class="animate-box" data-animate-effect="fadeInLeft">
		            <a href="<?php echo $backRedirect; ?>"><i class="icon-long-arrow-left"></i> <span>Kembali</span></a>
		          </p>
		        </div>
		        <div class="col-md-6 col-md-push-1 animate-box" data-animate-effect="fadeInLeft">
		        	<?php 
						$srcImg = $getByIdRumah["photo"] == "" ? "admin/img/omah_omahan.png" : "admin/upload/rumah/".$getByIdRumah['photo'];
					?>
					<div class="thumbnail">
						<img src="<?php echo $srcImg; ?>" alt="<?php echo $getByIdRumah["nama"]; ?>" style="width:450px; height:400px;" class="img-responsive">
					</div>
					<p class="fh5co-lead animate-box" data-animate-effect="fadeInLeft">
		          		Type: <?php echo $getByIdType["type"]; ?>
		          		<br>
		          		<small><?php echo $getByIdType["description"]; ?></small>
		          	</p>
		        </div>
		      </div>
		    </div>
		</div>
	</div>
</body>
<?php require_once 'template/footer.php'; ?>
