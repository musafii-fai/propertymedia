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
					<li class="fh5co-active"><a href="about.php">Tentang</a></li>
					<li><a href="contact.php">Kontak</a></li>
				</ul>
			</nav>

			<div class="fh5co-footer">
				<p><small>Copyright &copy; PropertyMedia 2017 <?php echo date("Y") > 2017 ? " - ".date("Y") : ""; ?>.</small></p>
				<?php require_once 'template/sosial_media.php'; ?>
			</div>
		</aside>

		<div id="fh5co-main">
		    <div class="fh5co-narrow-content fh5co-border-bottom">
		      <h2 class="fh5co-heading animate-box" data-animate-effect="fadeInLeft">Tentang</h2>
		      <hr>
		      <?php 
		      		require_once 'core/db_mysqli.php';
					require_once 'core/helper.php';

					$model  = new Model_mysqli();
					$model->setTable("info_about");
					$getById = $model->getById(1);
		      ?>
		      <div class="row">
		      	<div class="col-md-12">
		          <div class="fh5co-feature animate-box" data-animate-effect="fadeInLeft">
		            <div class="fh5co-icon">
		              <i class="icon-home"></i>
		            </div>
		            <div class="fh5co-text">
		              <h3>Profile Perusahaan</h3>
		              <p><?php echo $getById["profile"]; ?></p>
		            </div>
		          </div>
		        </div>
		        <div class="col-md-6">
		          <div class="fh5co-feature animate-box" data-animate-effect="fadeInLeft">
		            <div class="fh5co-icon">
		              <i class="icon-strategy"></i>
		            </div>
		            <div class="fh5co-text">
		              <h3>Strategi</h3>
		              <p><?php echo $getById["strategi"]; ?></p>
		            </div>
		          </div>
		        </div>
		        <div class="col-md-6">
		          <div class="fh5co-feature animate-box" data-animate-effect="fadeInLeft">
		            <div class="fh5co-icon">
		              <i class="icon-telescope"></i>
		            </div>
		            <div class="fh5co-text">
		              <h3>Visi</h3>
		              <p><?php echo $getById["visi"]; ?></p>
		            </div>
		          </div>
		        </div>

		        <div class="col-md-6">
		          <div class="fh5co-feature animate-box" data-animate-effect="fadeInLeft">
		            <div class="fh5co-icon">
		              <i class="icon-circle-compass"></i>
		            </div>
		            <div class="fh5co-text">
		              <h3>Tujuan</h3>
		              <p><?php echo $getById["tujuan"]; ?></p>
		            </div>
		          </div>
		        </div>
		        <div class="col-md-6">
		          <div class="fh5co-feature animate-box" data-animate-effect="fadeInLeft">
		            <div class="fh5co-icon">
		              <i class="icon-tools-2"></i>
		            </div>
		            <div class="fh5co-text">
		              <h3>Misi</h3>
		              <p><?php echo $getById["misi"]; ?></p>
		            </div>
		          </div>
		        </div>
		      </div>
		    </div>
		</div>
	</div>
</body>
<?php require_once 'template/footer.php'; ?>