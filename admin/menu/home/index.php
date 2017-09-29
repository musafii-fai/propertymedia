<!-- Icon Cards -->
<?php 
	$model = new Model_mysqli();
	$model->setTable("penjualan");
?>
<div class="row">
  <div class="col-xl-3 col-sm-6 mb-3">
    <div class="card text-white bg-primary o-hidden h-100">
      <div class="card-body">
        <div class="card-body-icon">
          <i class="fa fa-credit-card"></i>
        </div>
        <div class="mr-5">
          <?php echo $model->getCount(); ?> Penjualan
        </div>
      </div>
      <a href="?menu=penjualan" class="card-footer text-white clearfix small z-1">
        <span class="float-left">View Details</span>
        <span class="float-right">
          <i class="fa fa-angle-right"></i>
        </span>
      </a>
    </div>
  </div>
  <div class="col-xl-3 col-sm-6 mb-3">
    <div class="card text-white bg-warning o-hidden h-100">
      <div class="card-body">
        <div class="card-body-icon">
          <i class="fa fa-fw fa-home"></i>
        </div>
        <div class="mr-5">
        	<?php $model->setTable("rumah");?>
          	<?php echo $model->getCount(); ?> Rumah!
        </div>
      </div>
      <a href="?menu=rumah" class="card-footer text-white clearfix small z-1">
        <span class="float-left">View Details</span>
        <span class="float-right">
          <i class="fa fa-angle-right"></i>
        </span>
      </a>
    </div>
  </div>
  <div class="col-xl-3 col-sm-6 mb-3">
    <div class="card text-white bg-success o-hidden h-100">
      <div class="card-body">
        <div class="card-body-icon">
          <i class="fa fa-fw fa-shopping-cart"></i>
        </div>
        <div class="mr-5">
          	<?php $model->setTable("pembeli");?>
          	<?php echo $model->getCount(); ?> Pembeli!
        </div>
      </div>
      <a href="?menu=pembeli" class="card-footer text-white clearfix small z-1">
        <span class="float-left">View Details</span>
        <span class="float-right">
          <i class="fa fa-angle-right"></i>
        </span>
      </a>
    </div>
  </div>
  <div class="col-xl-3 col-sm-6 mb-3">
    <div class="card text-white bg-danger o-hidden h-100">
      <div class="card-body">
        <div class="card-body-icon">
          <i class="fa fa-fw fa-users"></i>
        </div>
        <div class="mr-5">
          	<?php $model->setTable("users");?>
          	<?php echo $model->getCount(); ?> Users!
        </div>
      </div>
      <a href="?menu=users" class="card-footer text-white clearfix small z-1">
        <span class="float-left">View Details</span>
        <span class="float-right">
          <i class="fa fa-angle-right"></i>
        </span>
      </a>
    </div>
  </div>
</div>

<!-- Example Bar Chart Card -->
<div class="card mb-3">
  <div class="card-header">
    <i class="fa fa-bar-chart"></i>
    Bar Chart Transaksi Penjualan <?php echo date("Y"); ?>
  </div>
  <div class="card-body">
    <div class="row">
      <div class="col-md-12 my-auto">
        <div class="chart">
            <canvas id="barChart" style="height:50%"></canvas>
        </div>
      </div>
    </div>
  </div>
</div>
  

<script type="text/javascript">

	$(function chart() {
		var areaChartData;
		$.post("?ajax=home",function(json) {
			if (json.status == true) {
				var areaChartData = {
			    labels  : ["Januari", "Februari", "Maret", "April", "Mei", "Juni","Juli", "Agustus", "September", "Oktober", "Nopember", "Desember"],
			      datasets: [
			        {
			          label               : 'Digital Goods',
			          fillColor           : 'rgba(60,141,188,0.9)',
			          strokeColor         : 'rgba(60,141,188,0.8)',
			          pointColor          : '#3b8bba',
			          pointStrokeColor    : 'rgba(60,141,188,1)',
			          pointHighlightFill  : '#fff',
			          pointHighlightStroke: 'rgba(60,141,188,1)',
			          data                : json.data,
			        }
			      ]
			    }

			     //-------------
			    //- BAR CHART -
			    //-------------
			    var barChartCanvas                   = $('#barChart').get(0).getContext('2d')
			    var barChart                         = new Chart(barChartCanvas)
			    var barChartData                     = areaChartData
			    var barChartOptions                  = {
			      //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
			      scaleBeginAtZero        : true,
			      //Boolean - Whether grid lines are shown across the chart
			      scaleShowGridLines      : true,
			      //String - Colour of the grid lines
			      scaleGridLineColor      : 'rgba(0,0,0,.05)',
			      //Number - Width of the grid lines
			      scaleGridLineWidth      : 1,
			      //Boolean - Whether to show horizontal lines (except X axis)
			      scaleShowHorizontalLines: true,
			      //Boolean - Whether to show vertical lines (except Y axis)
			      scaleShowVerticalLines  : false,
			      //Boolean - If there is a stroke on each bar
			      barShowStroke           : true,
			      //Number - Pixel width of the bar stroke
			      barStrokeWidth          : 5,
			      //Number - Spacing between each of the X value sets
			      barValueSpacing         : 5,
			      //Number - Spacing between data sets within X values
			      barDatasetSpacing       : 1,
			      //String - A legend template
			      legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
			      //Boolean - whether to make the chart responsive
			      responsive              : true,
			      maintainAspectRatio     : true
			    }

			    barChartOptions.datasetFill = false;
			    barChart.Bar(barChartData, barChartOptions);
			}
		});
	});

</script>