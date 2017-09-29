<?php 

	$model = new Model_mysqli();
	$model->setTable("penjualan");

	if ($model->isPost()) {
		$formatMonth = "DATE_FORMAT(tanggal_input,'%M')";
		$select = array(
						"SUM($formatMonth = 'January') AS Januari",
						"SUM($formatMonth = 'February') AS Februari",
						"SUM($formatMonth = 'March') AS Maret",
						"SUM($formatMonth = 'April') AS April",
						"SUM($formatMonth = 'May') AS Mei",
						"SUM($formatMonth = 'June') AS Juni", 
						"SUM($formatMonth = 'July') AS Juli", 
						"SUM($formatMonth = 'August') AS Agustus", 
						"SUM($formatMonth = 'September') AS September", 
						"SUM($formatMonth = 'October') AS Oktober", 
						"SUM($formatMonth = 'November') AS Nopember", 
						"SUM($formatMonth = 'December') AS Desember"
					);
		$where = array(
						"DATE_FORMAT(tanggal_input,'%Y')" => date("Y"),
					);

		$data = $model->findData($select,$where);
		$dataChart = [intval($data[0]["Januari"]),intval($data[0]["Februari"]),intval($data[0]["Maret"]),intval($data[0]["April"]),intval($data[0]["Mei"]),intval($data[0]["Juni"]),intval($data[0]["Juli"]),intval($data[0]["Agustus"]),intval($data[0]["September"]),intval($data[0]["Oktober"]),intval($data[0]["Nopember"]),intval($data[0]["Desember"])];
		
		$model->response->status = true;
		$model->response->data = $dataChart;
		$model->json();
	}

 ?>