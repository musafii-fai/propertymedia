<!-- Breadcrumbs -->
<ol class="breadcrumb">
  	<li class="breadcrumb-item">
    	<a href="/property/admin/">Dashboard</a>
 	</li>
  	<li class="breadcrumb-item active">Pemesanan</li>
</ol>

<div class="card border-primary">
	<div class="card-header">
		<div class="row">
			<div class="col-md-4">
				<button type="button" id="btnProsessPemesanan" class="btn btn-primary">Prosess Pemesanan <i class="fa fa-hand-o-up"></i></button>
			</div>
			<div class="col-md-6">
				<div id="inputMessage"></div>
			</div>
		</div>
	</div>
	<div class="card-body">
		<form id="formProsess" action="" method="POST">
		<div class="row">
			<div class="col-md-6">
				<div class="card border-success">
					<div class="card-header"><i class="fa fa-user"></i> Data Pembeli</div>
					<div class="card-body">
						<div class="form-group">
							<label>Nama</label>
							<input type="text" name="nama_pembeli" id="namaPembeli" class="form-control">
							<div id="errorNamaPembeli"></div>
						</div>
						<div class="form-row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Jenis Kelamin</label>
									<select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
										<option value="">--Pilih Jenis Kelamin--</option>
										<option value="laki-laki">Laki - laki</option>
										<option value="perempuan">Perempuan</option>
									</select>
									<div id="errorJenisKelamin"></div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Umur</label>
									<input type="number" name="umur" id="umur" min="0" max="200"  class="form-control">
									<div id="errorUmur"></div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label>Pekerjaan</label>
							<input type="text" name="pekerjaan" id="pekerjaan" class="form-control">
							<div id="errorPekerjaan"></div>
						</div>
						<div class="form-group">
							<label>Alamat</label>
							<textarea name="alamat" id="alamat" rows="4" class="form-control"></textarea>
							<div id="errorAlamat"></div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="card border-dark">
					<div class="card-header"><i class="fa fa-home"></i> Data Rumah</div>
					<div class="card-body">
						<div class="card border-warning">
							<div class="card-body">
								<div class="form-group">
									<?php 
										$modelRumah = new Model_mysqli();
										$modelRumah->setTable("rumah_kategori");
										$orderBy = array("type" => "ASC");
										$result = $modelRumah->findData(false,false,$orderBy);
									?>
									<label>Type</label>
									<select name="type_rumah" id="typeRumah" class="form-control">
										<option value="">--Pilih Type Rumah--</option>
										<?php foreach($result AS $item) : ?>
											<option value="<?php echo $item["id"]; ?>"><?php echo $item["type"]; ?></option>
										<?php endforeach; ?>
									</select>
								</div>
								<div class="form-group">
									<label>Rumah</label>
									<select name="rumah" id="rumah" class="form-control">
									</select>
									<div id="emptyRumah"></div>
									<div id="errorRumah"></div>
								</div>
								<div class="form-row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Blok Rumah</label>
											<select name="blok_rumah" id="blokRumah" class="form-control">
											</select>
										</div>
										<div id="errorBlokRumah"></div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>No Rumah</label>
											<input type="text" name="no_rumah" id="noRumah" class="form-control">
										</div>
										<div id="errorNoRumah"></div>
									</div>
								</div>
								<div id="blokNoRumah"></div>
							</div>
						</div>
						<br>
						<div id="detailRumah" class="card border-info">
							<div class="card-body">
								<div class="form-row">
									<div class="col-md-4">
										<img id="detailRumahPhoto" src="img/omah_omahan.png" style="width: 100px; height: 120px;" class="img-responsive img-thumbnail">
									</div>
									<div class="col-md-8">
										<label><b>Nama :</b> &nbsp;&nbsp;<span id="detailRumahNama"></span></label>
										<br>
										<label><b>Type &nbsp;&nbsp;:</b> &nbsp;&nbsp;<span id="detailRumahType"></span></label>
										<br>
										<label><b>Harga :</b> &nbsp;&nbsp;<span id="detailRumahHarga"></span></label>
										<table class="table table-sm">
											<thead>
												<tr>
													<th>Blok</th>
													<th>Jumlah</th>
												</tr>
											</thead>
											<tbody id="blokJumlah">
											</tbody>
										</table>
										<label><b>Lokasi :</b> &nbsp;&nbsp;<span id="detailRumahLokasi"></span></label>
									</div>
								</div>
							</div>
						</div>
					</div>		
				</div>
			</div>
		</div>
		</form>
	</div>
</div>

<script type="text/javascript">

	$(document).ready(function() {

		$("#detailRumah").hide();
		$("#typeRumah").change(function() {
			if ($(this).val() != "") {
				$.ajax({
					url: '?ajax=pemesanan/type_rumah',
					type: 'POST',
					dataType: 'json',
					data: 'type_rumah='+$(this).val(),
					success: function(json) {
						if (json.status == true) {

							htmlOption = '<option>--Pilih Rumah--</option>';
							$.each(json.data,function(i,v) {
								htmlOption += '<option value="'+v.id+'">'+v.nama+'</option>';
							});
							$("#rumah").html(htmlOption);
							$("#emptyRumah").html("");
						} else {
							$("#rumah").html("");
							$("#emptyRumah").html(json.message);
							$("#detailRumah").hide();
							$("#blokRumah").html("");
						}
					}
				});
			} else {
				$("#rumah").html("");
				$("#detailRumah").hide();
				$("#blokRumah").html("");
				$("#emptyRumah").html("");
			}
		});
		
		$("#rumah, #typeRumah").change(function() {
			if ($(this).val() != "") {
				$("#detailRumah").show();
				$.ajax({
					url: '?ajax=pemesanan/detail_rumah',
					type: 'POST',
					dataType: 'json',
					data:'rumah='+$("#rumah").val(),
					success: function(json) {
						if (json.status == true) {

							htmlOption = '<option value="">--Pilih Blok--</option>';
							$.each(json.data.blok_jumlah,function(i,v) {
								htmlOption += '<option value="'+v.blok+'">'+v.blok+'</option>';
							});
							$("#blokRumah").html(htmlOption);

							img = json.data.photo == "" ? "img/omah_omahan.png" : "upload/rumah/"+json.data.photo;
							$("#detailRumahPhoto").attr("src",img);
							$("#detailRumahNama").text(json.data.nama);
							$("#detailRumahType").text(json.data.type);
							$("#detailRumahHarga").text(json.data.harga);

							trTable = null;
							$.each(json.data.blok_jumlah,function(i,v) {
								trTable += "<tr>";
								trTable += "<td>"+v.blok+"</td>";
								trTable += "<td>"+v.jumlah+"</td>";
								trTable += "<tr>";
							});
							$("#blokJumlah").html(trTable);

							$("#detailRumahLokasi").text(json.data.lokasi);
						} else {
							$("#blokRumah").html("");
							img = "img/omah_omahan.png";
							$("#detailRumahPhoto").attr("src",img);
							$("#detailRumahNama").text("");
							$("#detailRumahType").text("");
							$("#detailRumahHarga").text("");
							$("#detailRumahLokasi").text("");
							$("#detailRumah").hide();
						}
					}
				});
			} else {
				$("#detailRumah").hide();
				$("#blokRumah").html("");
			}
		});

		$("#btnProsessPemesanan").click(function() {
			$("#btnProsessPemesanan").attr("disabled",true);
			$.ajax({
				url: '?ajax=pemesanan',
				type: 'POST',
				dataType: 'json',
				data:$("#formProsess").serialize(),
				success: function(json) {
					if (json.status == true) {
						$("#inputMessage").html(json.message);
						setTimeout(function() {
							$("#inputMessage").html("");
							window.location.href = '?menu=pemesanan';
						},4000);
					} else {
						if (json.error.totalRumah) {
							$("#errorRumah").html(json.error.totalRumah);
							setTimeout(function() {
								$("#errorRumah").html("");
								$("#btnProsessPemesanan").attr("disabled",false);
							},5000);
						} else if(json.error.blokNoRumah) {
							$("#blokNoRumah").html(json.error.blokNoRumah);

							setTimeout(function() {
								$("#blokNoRumah").html("");
								$("#btnProsessPemesanan").attr("disabled",false);
							},5000);
						} else if(json.error.noRumahBlok) {
							$("#blokNoRumah").html(json.error.noRumahBlok);

							setTimeout(function() {
								$("#blokNoRumah").html("");
								$("#btnProsessPemesanan").attr("disabled",false);
							},5000);
						} else if(json.error.jumlahRumahBlok) {
							$("#blokNoRumah").html(json.error.jumlahRumahBlok);

							setTimeout(function() {
								$("#blokNoRumah").html("");
								$("#btnProsessPemesanan").attr("disabled",false);
							},5000);
						} else {
							$("#errorNamaPembeli").html(json.error.nama_pembeli);
							$("#errorJenisKelamin").html(json.error.jenis_kelamin);
							$("#errorUmur").html(json.error.umur);
							$("#errorPekerjaan").html(json.error.pekerjaan);
							$("#errorAlamat").html(json.error.alamat);
							$("#errorRumah").html(json.error.id_rumah);
							$("#errorBlokRumah").html(json.error.blok_rumah);
							$("#errorNoRumah").html(json.error.no_rumah);

							setTimeout(function() {
								$("#errorNamaPembeli").html("");
								$("#errorJenisKelamin").html("");
								$("#errorUmur").html("");
								$("#errorPekerjaan").html("");
								$("#errorAlamat").html("");
								$("#errorRumah").html("");
								$("#errorBlokRumah").html("");
								$("#errorNoRumah").html("");
								$("#btnProsessPemesanan").attr("disabled",false);
							},5000);
						}
					}
				}
			});
		});
	});
	
</script>