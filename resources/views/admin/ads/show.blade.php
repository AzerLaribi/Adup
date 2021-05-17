@extends('layouts.admin')
@section('content')
@can('user_management_access')
<div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
        <form action="{{ action('Admin\AdController@validation',$ad->id) }}" method="POST" class="float-left" enctype="multipart/form-data">
            @csrf
            @method('PUT')
                    <button type="submit" class="btn btn-success btn-circle mr-1">
                        <i class="fas fa-check"></i>  validation {{ $ad->title }} Ad
                    </button>
            </form>
        </div>
</div>
@endcan
<div class="card">
    <div class="card-header">
       View a Ad : {{ $ad->title ?? '' }} <span> <p id="p1"></p></span>
    </div>
    <div class="row">
        <div class="col-md-4 "  onLoad="getDur()">
            <div class="row justify-content-center">
                <video id="myVideo" width="320" height="176" controls>
                    <source src="{{ asset('/Ads/Video/'.$ad->video)}}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <!-- small box -->
            @can('advertiser')
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{$vuCount}}</h3>

                <p>vue</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
            </div>
            @endcan
        </div>
        <div class="col-lg-3 col-6">
                <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{$locationCount}}</h3>
                   <a  href="/admin/{{$ad->id}}/adLocations"> <p>location</p> </a>

                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
            </div>
        </div>

    </div>
    @can('user_management_access')
        <div class="card-body">
            <div class="mb-2">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>
                                Ad Information
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>
                                Name
                            </th>
                            <td>
                                {{ $ad->title }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Description
                            </th>
                            <td>
                                {{ $ad->description }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Strat
                            </th>
                            <td>
                                {{ $ad->start }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                adresse
                            </th>
                            <td>
                                {{ $ad->end }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Owner
                            </th>
                            <td>
                                {{ $ad->owner}}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Status
                            </th>
                            <td>
                            @if($ad->status==0) Waiting @elseif($ad->status==1) Accepted @else Refused @endif
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Video Duration
                            </th>
                            <td>
                            <p id="p2"></p>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Generating Leads
                            </th>
                            <td>
                                {{ $ad->link}}

                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
@endcan
@can('advertiser')
    <div class="card-body">

        <nav class="mb-3">
            <div class="nav nav-tabs">

            </div>
        </nav>
        <div class="tab-content">
        <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-8">
            <!-- AREA CHART -->
            <div class="card card-primary" style="display:none" >
              <div class="card-header">
                <h3 class="card-title">Users Chart</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                </div>
              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="areaChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
            </div>
          </div>


        </div>
          <div class="col-md-12">
            <!-- LINE CHART -->
            <div class="card card-info" >

              <div class="card-body" style="display:none">
                <div class="chart">
                  <canvas id="lineChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
              <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">vus </h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                </div>
              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
              <!-- /.card-body -->
          </div>
          <div class="row">
          <div class="col-md-6">
            <!-- AREA CHART -->
            <div class="card card-primary" style="display:none">
              <div class="card-header">
                <h3 class="card-title">Area Chart</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                </div>
              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="areaChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- DONUT CHART -->
            <div class="card card-danger"  >
              <div class="card-header">
                <h3 class="card-title">Donut Chart</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                </div>
              </div>
              <div class="card-body">
                <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- PIE CHART -->


          </div>
          <div class="col-md-6">
            <div class="card card-danger" >
              <div class="card-header">
                <h3 class="card-title">Pie Chart</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                </div>
              </div>
              <div class="card-body">
                <canvas id="pieChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            </div>
      </div>
</section>


</div>
@endcan



<!-- jQuery -->
<!-- Bootstrap 4 -->
<!-- ChartJS -->
<script src="../../plugins/chart.js/Chart.min.js"></script>
<!-- AdminLTE App -->
<!-- AdminLTE for demo purposes -->
<!-- page script -->
@section('scripts')
<script>
var vid = document.getElementById("myVideo");

function getCurTime() {
  alert(vid.currentTime);
}

function setCurTime() {
  vid.currentTime=5;
}
function setDuration() {
  alert(vid.duration);
}
document.getElementById("p1").innerHTML = "Video Duration : " + vid.duration + " sec";
document.getElementById("p2").innerHTML = vid.duration + " sec";

</script>
<script>
  $(function () {
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */

    //--------------
    //- AREA CHART -
    //--------------

    // Get context with jQuery - using jQuery's .get() method.

    var todayDate=new Date(); //Today's Date
    var today= moment(todayDate).format("YYYY/MM/DD");
    var todayString =today.toString();

    //today -1
    var yesterdaydate=new Date(todayDate.getFullYear(),todayDate.getMonth(),todayDate.getDate()-1);
    var yesterday= moment(yesterdaydate).format("YYYY/MM/DD");
    var yesterdayString =yesterday.toString();

    //today -2
    var daybeforyesterdaydate=new Date(todayDate.getFullYear(),todayDate.getMonth(),todayDate.getDate()-2);
    var daybeforyesterday= moment(daybeforyesterdaydate).format("YYYY/MM/DD");
    var daybeforyesterdaydateString =daybeforyesterday.toString();

    //today -3
    var towyesterdaysdate=new Date(todayDate.getFullYear(),todayDate.getMonth(),todayDate.getDate()-3);
    var towyesterdays= moment(towyesterdaysdate).format("YYYY/MM/DD");
    var towyesterdaysString =towyesterdays.toString();


  //today +1
    var tommorowdate=new Date(todayDate.getFullYear(),todayDate.getMonth(),todayDate.getDate()+1);
    var tommorw= moment(tommorowdate).format("YYYY/MM/DD");
    var tommorwStrring =tommorw.toString();
  //today +2
    var afterTomorwwDate=new Date(todayDate.getFullYear(),todayDate.getMonth(),todayDate.getDate()+2);
    var afterTomorww= moment(afterTomorwwDate).format("YYYY/MM/DD");
    var afterTomorwwStrring =afterTomorww.toString();

  //today +3
    var afterafterTomorwwDate=new Date(todayDate.getFullYear(),todayDate.getMonth(),todayDate.getDate()+3);
    var afterafterTomorww= moment(afterafterTomorwwDate).format("YYYY/MM/DD");
    var afterafterTomorwwStrring =afterafterTomorww.toString();

    var areaChartCanvas = $('#areaChart').get(0).getContext('2d')

    var areaChartData = {
      labels  : [towyesterdaysString, daybeforyesterdaydateString, yesterdayString,todayString, tommorwStrring, afterTomorwwStrring,afterafterTomorwwStrring],
      datasets: [
        {
          label               : 'Vus',
          backgroundColor     : 'rgba(60,141,188,0.9)',
          borderColor         : 'rgba(60,141,188,0.8)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [ <?php echo $lastlastYesterdayVus?>, <?php echo $lastyesterdayVus?>, <?php echo $yesterdayVus?>, <?php echo $todayVus?>,
          <?php echo $tomorowVus?>, <?php echo $aftertomorowVus?>,  <?php echo $afteraftertomorowVus?>]
        },
        {


        },
      ]
    }

    var areaChartOptions = {
      maintainAspectRatio : false,
      responsive : true,
      legend: {
        display: false
      },
      scales: {
        xAxes: [{
          gridLines : {
            display : false,
          }
        }],
        yAxes: [{
          gridLines : {
            display : false,
          }
        }]
      }
    }

    // This will get the first returned node in the jQuery collection.
    var areaChart       = new Chart(areaChartCanvas, {
      type: 'line',
      data: areaChartData,
      options: areaChartOptions
    })

    //-------------
    //- LINE CHART -
    //--------------
    var lineChartCanvas = $('#lineChart').get(0).getContext('2d')
    var lineChartOptions = jQuery.extend(true, {}, areaChartOptions)
    var lineChartData = jQuery.extend(true, {}, areaChartData)
    lineChartData.datasets[0].fill = false;
    lineChartData.datasets[1].fill = false;
    lineChartOptions.datasetFill = false

    var lineChart = new Chart(lineChartCanvas, {
      type: 'line',
      data: lineChartData,
      options: lineChartOptions
    })

    //-------------
    //- DONUT CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
    var donutData        = {
      labels: [
          '[12 ,15]',
          '[16 ,18] ',
          '[19 ,29 ]',
          '[30 ,60]',
          '>60',

      ],
      datasets: [
        {
          data: [<?php echo $youngs?>,<?php echo $youngAdults?>,<?php echo $adults?>
          ,<?php echo $middleAged?>,<?php echo $old?>],
          backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
        }
      ]
    }
    var piee        = {
      labels: [

          'males',
          'females',

      ],
      datasets: [
        {
          data: [<?php echo $males?>,<?php echo $females?>,],
          backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
        }
      ]
    }
    var donutOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    var donutChart = new Chart(donutChartCanvas, {
      type: 'doughnut',
      data: donutData,
      options: donutOptions
    })

    //-------------
    //- PIE CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
    var pieData        = piee;
    var pieOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    var pieChart = new Chart(pieChartCanvas, {
      type: 'pie',
      data: pieData,
      options: pieOptions
    })

    //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas = $('#barChart').get(0).getContext('2d')
    var barChartData = jQuery.extend(true, {}, areaChartData)
    var temp0 = areaChartData.datasets[0]
    var temp1 = areaChartData.datasets[1]
    barChartData.datasets[0] = temp1
    barChartData.datasets[1] = temp0

    var barChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      datasetFill             : false
    }

    var barChart = new Chart(barChartCanvas, {
      type: 'bar',
      data: barChartData,
      options: barChartOptions
    })

    //---------------------
    //- STACKED BAR CHART -
    //---------------------
    var stackedBarChartCanvas = $('#stackedBarChart').get(0).getContext('2d')
    var stackedBarChartData = jQuery.extend(true, {}, barChartData)

    var stackedBarChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      scales: {
        xAxes: [{
          stacked: true,
        }],
        yAxes: [{
          stacked: true
        }]
      }
    }

    var stackedBarChart = new Chart(stackedBarChartCanvas, {
      type: 'bar',
      data: stackedBarChartData,
      options: stackedBarChartOptions
    })
  })
</script>

@endsection


@endsection
