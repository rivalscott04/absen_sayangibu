{{-- layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Data Kehadiran')

{{-- vendor styles --}}
@section('vendor-style')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/flag-icon/css/flag-icon.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/data-tables/css/jquery.dataTables.min.css')}}">
<link rel="stylesheet" type="text/css"
  href="{{asset('vendors/data-tables/extensions/responsive/css/responsive.dataTables.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/data-tables/css/select.dataTables.min.css')}}">
@endsection

{{-- page style --}}
@section('page-style')
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/data-tables.css')}}">
@endsection

{{-- page content --}}
@section('content')
<div class="section section-data-tables">
  <div class="card">
    <div class="card-content">
      <p class="caption mb-0">Tables are a nice way to organize a lot of data. We provide a few utility classes to help
        you style your table as easily as possible. In addition, to improve mobile experience, all tables on
        mobile-screen widths are centered automatically.</p>
    </div>
  </div>

  <!-- Page Length Options -->
  <div class="row">
    <div class="col s12">
      <div class="card">
        <div class="card-content">
          <h4 class="card-title">Page Length Options</h4>
          <div class="row">
            <div class="col s12">
              <table id="page-length-option" class="display">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Kartu ID</th>
                    <th>Tanggal</th>
                    <th>Kelas</th>
                    <th>Jam Masuk</th>
                    <th>Jam Absen</th>
                    <th>No Mesin</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($data as $i)
                      <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$i->kartu_id}}</td>
                        <td>{{$i->tanggal}}</td>
                        <td>{{$i->kelas}}</td>
                        <td>{{$i->jam_masuk}}</td>
                        <td>{{$i->jam_absen}}</td>
                        <td>{{$i->no_mesin}}</td>
                        <td>{{$i->status}}</td>
                      </tr>
                  @endforeach
                </tbody>
                <tfoot>
                  <tr>
                    <th>No</th>
                    <th>Kartu ID</th>
                    <th>Tanggal</th>
                    <th>Kelas</th>
                    <th>Jam Masuk</th>
                    <th>Jam Absen</th>
                    <th>No Mesin</th>
                    <th>Status</th>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection


{{-- vendor scripts --}}
@section('vendor-script')
<script src="{{asset('vendors/data-tables/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('vendors/data-tables/js/dataTables.select.min.js')}}"></script>
@endsection

{{-- page script --}}
@section('page-script')
<script src="{{asset('js/scripts/data-tables.js')}}"></script>
<script src="{{asset('js/scripts/siswa.js')}}"></script>
@endsection



