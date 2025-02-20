{{-- layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Data Kehadiran')

{{-- vendor styles --}}
@section('vendor-style')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/flag-icon/css/flag-icon.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/data-tables/css/jquery.dataTables.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/data-tables/extensions/responsive/css/responsive.dataTables.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/data-tables/css/select.dataTables.min.css')}}">
@endsection

{{-- page style --}}
@section('page-style')
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/data-tables.css')}}">
@endsection

{{-- page content --}}
@section('content')
<div class="col s12">
  <a href="/" class="breadcrumb">Home</a>
  <a href="#" class="breadcrumb">Attendance</a>
  <a href="/rekap" class="breadcrumb">Rekap</a>
</div>
<br>
<div class="section section-data-tables">
  <div class="card">
    <div class="card-content">
      <h5 class="mb-0 mt-0" style="font-weight:bold">REKAP KEHADIRAN</h5>
    </div>
  </div>

  <!-- Page Length Options -->
  <div class="row">
    <div class="col s12">
      <div class="card">
        <div class="card-content">
          <div class="row">
            <form method="GET" action="{{ route('rekap.index') }}">
              <div class="col s12 m3">
                <label for="start_date">Tanggal Mulai:</label>
                <input type="date" id="start_date" name="start_date" value="{{ request('start_date') }}">
              </div>
              <div class="col s12 m3">
                <label for="end_date">Tanggal Akhir:</label>
                <input type="date" id="end_date" name="end_date" value="{{ request('end_date') }}">
              </div>
              <div class="col s12 m3">
                <label for="nis_id">NIS ID:</label>
                <input type="text" id="nis_id" name="nis_id" value="{{ request('nis_id') }}">
              </div>
              <br>
              <div class="col s12 m3">
                <button class="btn waves-effect waves-light" type="submit">Submit
                  <i class="material-icons right">send</i>
                </button>
              </div>
            </form>
          </div>
          <a href="{{ route('rekap.export', request()->query()) }}" class="btn waves-effect waves-light gradient-45deg-purple-deep-purple modal-trigger">Export to Excel</a>
          <br><br>
          <h4 class="card-title">Page Length Options</h4>
          <div class="row">
            <div class="col s12">
              <!-- <table id="page-length-option" class="display"> -->
              <table>
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Kartu ID</th>
                    <th>Nama</th>
                    <th>Tanggal</th>
                    <th>Kelas</th>
                    <th>Waktu Mulai</th>
                    <th>Waktu Selesai</th>
                    <th>Jam Absen</th>
                    <th>No Mesin</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($rekaps as $i)
                  <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$i->kartu_id}}</td>
                    <td>{{$i->nama}}</td>
                    <td>{{$i->tanggal}}</td>
                    <td>{{$i->kelas}}</td>
                    <td>{{$i->waktu_mulai}}</td>
                    <td>{{$i->waktu_selesai}}</td>
                    <td>{{$i->jam_absen}}</td>
                    <td>{{$i->no_mesin}}</td>
                    <td>
                      @if ($i->status == 1)
                      <span class="badge blue">Tepat Waktu</span>
                      @elseif ($i->status == 2)
                      <span class="badge yellow">Terlambat</span>
                      @else
                      <span class="badge red">Tidak Hadir</span>
                      @endif
                    </td>
                  </tr>
                  @endforeach
                </tbody>
                <tfoot>
                  <tr>
                    <th>No</th>
                    <th>Kartu ID</th>
                    <th>Nama</th>
                    <th>Tanggal</th>
                    <th>Kelas</th>
                    <th>Waktu Mulai</th>
                    <th>Waktu Selesai</th>
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