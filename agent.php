<?php require_once 'template/header.php'; ?>
<body>
	<div id="fh5co-page">
		<a href="#" class="js-fh5co-nav-toggle fh5co-nav-toggle"><i></i></a>
		<aside id="fh5co-aside" role="complementary" class="border js-fullheight">

			<h1 id="fh5co-logo"><a href="index.php"><img src="images/llogo.png" alt="Property Media"></a></h1>
			<nav id="fh5co-main-menu" role="navigation">
				<ul>
					<li><a href="index.php">Home</a></li>
					<li class="fh5co-active"><a href="agent.php">Agent</a></li>
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
			<div class="fh5co-narrow-content  animate-box" data-animate-effect="fadeInLeft">
				<h2 class="fh5co-heading" >Agent</h2>
				<hr>
				<?php 
					require_once 'core/db_mysqli.php';
					require_once 'core/helper.php';

					$model  = new Model_mysqli();
					$model->setTable("users");
					$result = $model->findData(false,array("role" => "admin"));
					// var_dump($result);
				?>
				<div class="row">
					<?php foreach($result as $item) { ?>
						<div class="col-md-4 fh5co-staff">
							<div class="fh5co-feature fh5co-feature-sm animate-box fadeInLeft animated" data-animate-effect="fadeInLeft">
								<div class="thumbnail">
									<center>
										<?php 
											$srcImg = $item["photo"] == "" ? "/admin/img/user_image.png" : "/admin/upload/users/".$item['photo'];
										?>
										<img src="<?php echo $srcImg; ?>" alt="<?php echo $item["nama"]; ?>" style="height:150px; width:150px;" class="img-responsive">
										<h3><?php echo $item["nama"]; ?></h3>
										<br>
										<p><i class="icon-envelope-o"></i> <?php echo $item["email"]; ?></p>
									</center>
								</div>
							</div>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</body>
<?php require_once 'template/footer.php'; ?>
