{{-- layout extend --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Dashboard')

{{-- vendor styles --}}
@section('vendor-style')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/animate-css/animate.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/chartist-js/chartist.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/chartist-js/chartist-plugin-tooltip.css')}}">
@endsection

{{-- page styles --}}
@section('page-style')
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/dashboard-modern.css')}}">
<!-- <link rel="stylesheet" type="text/css" href="{{asset('css/pages/intro.css')}}"> -->
@endsection

{{-- page content --}}
@section('content')
<div class="section">
   <!-- jumlah siswa-->
   <div class="row vertical-modern-dashboard">
      <div class="col s12 m4 l4">
         <div class="card animate fadeLeft">
            <div class="card-content">
               <h4 class="card-title center">Jumlah Siswa Kelas 7</h4>
               <div class="sample-chart-wrapper"><canvas id="doughnut-chart" height="400"></canvas></div>
               <!-- <p class="header center">Doughnut Charts</p> -->
            </div>
         </div>
      </div>
      <div class="col s12 m4 l4">
         <div class="card animate">
            <div class="card-content">
               <h4 class="card-title center">Jumlah Siswa Kelas 8</h4>
               <div class="sample-chart-wrapper"><canvas id="doughnut-chart2" height="400"></canvas></div>
               <!-- <p class="header center">Doughnut Charts</p> -->
            </div>
         </div>
      </div>
      <div class="col s12 m4 l4">
         <div class="card animate fadeRight">
            <div class="card-content">
               <h4 class="card-title center">Jumlah Siswa Kelas 9</h4>
               <div class="sample-chart-wrapper"><canvas id="doughnut-chart3" height="400"></canvas></div>
               <!-- <p class="header center">Doughnut Charts</p> -->
            </div>
         </div>
      </div>
   </div>
   <!--/ Current balance & total transactions cards-->

   <!-- User statistics & appointment cards-->
   <div class="row vertical-modern-dashboard">
      <div class="col s12">
         <!-- User Statistics -->
         <!-- <div class="card user-statistics-card animate fadeLeft">
            <div class="card-content">
               <h4 class="card-title mb-0">User Statistics <i class="material-icons float-right">more_vert</i></h4>
               <div class="row">
                  <div class="col s12 m6">
                     <ul class="collection border-none mb-0">
                        <li class="collection-item avatar">
                           <i class="material-icons circle pink accent-2">trending_up</i>
                           <p class="medium-small">This year</p>
                           <h5 class="mt-0 mb-0">60%</h5>
                        </li>
                     </ul>
                  </div>
                  <div class="col s12 m6">
                     <ul class="collection border-none mb-0">
                        <li class="collection-item avatar">
                           <i class="material-icons circle purple accent-4">trending_down</i>
                           <p class="medium-small">Last year</p>
                           <h5 class="mt-0 mb-0">40%</h5>
                        </li>
                     </ul>
                  </div>
               </div>
               <div class="user-statistics-container">
                  <div id="user-statistics-bar-chart" class="user-statistics-shadow"></div>
               </div>
            </div>
         </div> -->
         <div class="card animate fadeLeft">
            <div class="card-content">
               <h4 class="card-title center">Statistik Kehadiran</h4>
               <div class="sample-chart-wrapper"><canvas id="bar-chart" height="400"></canvas></div>
               <!-- <p class="header center">Doughnut Charts</p> -->
            </div>
         </div>
      </div>
   </div>
</div>
@endsection

{{-- vendor scripts --}}
@section('vendor-script')
<script src="{{asset('vendors/chartjs/chart.min.js')}}"></script>
<script src="{{asset('vendors/chartist-js/chartist.min.js')}}"></script>
<script src="{{asset('vendors/chartist-js/chartist-plugin-tooltip.js')}}"></script>
<script src="{{asset('vendors/chartist-js/chartist-plugin-fill-donut.min.js')}}"></script>
@endsection

{{-- page scripts --}}
@section('page-script')
<script src="{{asset('js/scripts/charts-chartjs.js')}}"></script>
<script src="{{asset('js/scripts/dashboard-modern.js')}}"></script>
<!-- <script src="{{asset('js/scripts/intro.js')}}"></script> -->
@endsection