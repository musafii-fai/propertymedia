<?php require_once 'template/header.php'; ?>
<body>
	<div id="fh5co-page">
		<a href="#" class="js-fh5co-nav-toggle fh5co-nav-toggle"><i></i></a>
		<aside id="fh5co-aside" role="complementary" class="border js-fullheight">
			<h1 id="fh5co-logo"><a href="index.php"><img src="images/llogo.png" alt="Property Media"></a></h1>
			<nav id="fh5co-main-menu" role="navigation">
				<ul>
					<li><a href="index.php">Home</a></li>
					<li><a href="agent.php">Agent</a></li>
					<li><a href="pembeli.php">Pembeli</a></li>
					<li><a href="about.php">Tentang</a></li>
					<li class="fh5co-active"><a href="contact.php">Kontak</a></li>
				</ul>
			</nav>

			<div class="fh5co-footer">
				<p><small>Copyright &copy; PropertyMedia 2017 <?php echo date("Y") > 2017 ? " - ".date("Y") : ""; ?>.</small></p>
				<?php require_once 'template/sosial_media.php'; ?>
			</div>
		</aside>

		<div id="fh5co-main">
			<div class="fh5co-narrow-content animate-box" data-animate-effect="fadeInLeft">
				<h2 class="fh5co-heading">Kontak</h2>
				<hr><br>
				<?php 
					require_once 'core/db_mysqli.php';
					require_once 'core/helper.php';

					$model  = new Model_mysqli();
					$model->setTable("contact");

					if (isset($_POST["btnSend"])) {
						$nama = $_POST["nama"];
						$email = $_POST["email"];
						$phone = $_POST["phone"];
						$message = $_POST["message"];

						if (!empty(trim($nama)) && !empty(trim($email)) && !empty(trim($phone)) && !empty(trim($message))) {
							$data = array(
											"nama"	=>	$nama,
											"email"	=>	$email,
											"phone"	=>	$phone,
											"message"	=>	$message,
										);
							$sending = $model->insert($data);
							if ($sending) {
								echo "<script> alert('Data berhasil di Kirim'); </script>";
	                        	echo "<script> document.location.href = 'contact.php'; </script>";
							}
						} else {
							$errorFormData = Helper::spanDanger("Type, luas, atau description tidak boleh kosong..!");
	                		$errorFormData .=  "<br><br>";
						}
					}
				 ?>
				<form action="" method="post">
					<div class="row">
						<div class="col-md-12">
							<div><?php echo isset($errorFormData) ? $errorFormData : ""; ?></div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<input type="text" class="form-control" name="nama" value="<?php echo isset($nama) ? $nama : ""; ?>" required placeholder="Name">
									</div>
									<div class="form-group">
										<input type="email" class="form-control" name="email" value="<?php echo isset($email) ? $email : ""; ?>" required placeholder="Email">
									</div>
									<div class="form-group">
										<input type="text" class="form-control" name="phone" value="<?php echo isset($phone) ? $phone : ""; ?>" required placeholder="Phone">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<textarea name="message"  cols="30" rows="7" class="form-control" required placeholder="Message"><?php echo isset($message) ? $message : ""; ?></textarea>
									</div>
									<div class="form-group">
										<input type="submit" name="btnSend" class="btn btn-primary btn-md" value="Send Message">
									</div>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="fh5co-more-contact">
				<div class="fh5co-narrow-content">
					<?php 
						$modelAbout = new Model_mysqli();
						$modelAbout->setTable("info_about");
						$getById = $modelAbout->getById(1);
					 ?>
					<div class="row">
						<div class="col-md-4">
							<div class="fh5co-feature fh5co-feature-sm animate-box" data-animate-effect="fadeInLeft">
								<div class="fh5co-icon">
									<i class="icon-envelope-o"></i>
								</div>
								<div class="fh5co-text">
									<p><?php echo $getById["email"]; ?></p>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="fh5co-feature fh5co-feature-sm animate-box" data-animate-effect="fadeInLeft">
								<div class="fh5co-icon">
									<i class="icon-map-o"></i>
								</div>
								<div class="fh5co-text">
									<p><?php echo $getById["alamat"]; ?></p>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="fh5co-feature fh5co-feature-sm animate-box" data-animate-effect="fadeInLeft">
								<div class="fh5co-icon">
									<i class="icon-phone"></i>
								</div>
								<div class="fh5co-text">
									<p><?php echo $getById["no_telp"]; ?></p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
<?php require_once 'template/footer.php'; ?>
