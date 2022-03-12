@extends('layouts.AdminLayouts.layout')
@section('content')
<div class="col-12 col-lg-9 border border-dark rounded p-3">
    <div class="container">
        <div class="row align-items-start">
            <div class="col">
            </div>
            <div class="col-6">
                <h3><i class="fas fa-chart-line"></i> &nbsp &nbsp Product Selling Statistics</h3> 
            </div>
            <div class="col-2">
            </div>
        </div>
        <hr class="mb-4">
        <div class="row justify-content-center mt-3">
            <div class="card w-100 bg-light  text-dark border border-primary">
                <div class="card-header" align="center"><b>Product Selling Bar Chart by Order Counting</b></div>
                    <div class="card-body">
                    <center><div id="columnchart" style="width: 500px; height: 400px;"></div></center>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('ChartScript')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Products', 'Orders'],
          <?php echo $chartData; ?>
        ]);

        var options = {
          title: 'Product Orders',
          backgroundColor: 'transparent',
          is3D: true,
          legend : { position : 'bottom' }
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('columnchart'));

        chart.draw(data, options);
      }
</script>
@endsection