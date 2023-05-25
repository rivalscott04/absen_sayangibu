{{-- layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Data Jadwal')

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
<div class="col s12">
  <a href="/" class="breadcrumb">Home</a>
  <a href="/jadwal" class="breadcrumb">Jadwal</a>
</div>
<br>
<div class="section section-data-tables">
  <div class="card">
    <div class="card-content">
      {{-- <p class="caption mb-0">Tables are a nice way to organize a lot of data. We provide a few utility classes to help
        you style your table as easily as possible. In addition, to improve mobile experience, all tables on
        mobile-screen widths are centered automatically.</p> --}}
        <h5 class="mb-0 mt-0" style="font-weight: bold">JADWAL</h5>
    </div>
  </div>

  <!-- Page Length Options -->
  <div class="row">
    <div class="col s12">
      <div class="card">
        <div class="card-content">
          <span class="card-title">
            <a class= "waves-effect waves-light btn gradient-45deg-light-blue-cyan modal-trigger" href="#tambah-data">
              <i class="material-icons left">add_box</i> Tambah Jadwal
            </a>
          </span>

          <!-- tambah data -->
          <div id="tambah-data" class="modal">
            <div class="modal-content">
              <h4>Tambah Jadwal</h4>
              {{-- <form id="form-tambah-data" method="POST" action="{{route('api.siswa.store')}}" enctype="multipart/form-data"> --}}
              <form id="form-tambah-data" enctype="multipart/form-data">
                @csrf
                <div class="row">
                  <div class="input-field col m6 s12">
                    <input id="nama" name="nama" type="text" required>
                    <label for="nama">Nama</label>
                  </div>
                  <div class="input-field col m6 s12">
                    <input id="tanggal" name="tanggal" type="date" required>
                    <label for="tanggal">Tanggal</label>
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col m6 s12">
                    <input id="waktu_mulai" name="waktu_mulai" type="time" required>
                    <label for="waktu_mulai">Waktu Mulai</label>
                  </div>
                  <div class="input-field col m6 s12">
                    <input id="waktu_selesai" name="waktu_selesai" type="time" required>
                    <label for="waktu_selesai">Waktu Selesai</label>
                  </div>
                </div>
                <div class="row mt-10">
                  <div class="row">
                    <div class="input-field col s12">
                      <button class="btn cyan waves-effect waves-light right" type="submit" name="action">Submit
                        <i class="material-icons right">send</i>
                      </button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>

          <!-- edit data -->
          <div id="edit-data" class="modal">
            <div class="modal-content">
              <h4>Edit Mesin</h4>
              <form id="form-edit-mesin" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- @method('PUT') -->
                <div class="row">
                  <div class="input-field col m6 s12">
                    <input id="id-edit" name="id-edit" type="text" required hidden>
                    <input id="nama-edit" placeholder="nama" name="nama" type="text" value="" required>
                    <label for="nama">Nama</label>
                  </div>
                </div>
                <div class="row">
                  <div class="row">
                    <div class="input-field col s12">
                      <button class="btn cyan waves-effect waves-light right" type="submit" id="update">Update
                        <i class="material-icons right">send</i>
                      </button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>

          <h4 class="card-title">Page Length Options</h4>
          <div class="row">
            <div class="col s12">
              <table id="page-length-option" class="display">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Tanggal</th>
                    <th>Waktu Mulai</th>
                    <th>Waktu Selesai</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($data as $i)
                      <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$i->nama}}</td>
                        <td>{{$i->tanggal}}</td>
                        <td>{{$i->waktu_mulai}}</td>
                        <td>{{$i->waktu_selesai}}</td>
                        <td>
                          @if ($i->aktif===0)
                              <span class="badge red">Offline</span>
                          @else
                              <span class="badge blue">Online</span>
                          @endif
                        </td>
                        <td>
                          {{-- <a href="#" class="btn orange darken-3 mr-1 edit-link" data-id="{{$i->id}}"><i class="material-icons left">edit</i>Edit</a> --}}
                          <!-- <a href="{{url('siswa').'/'.$i->id}}" class="btn btn-primary orange darken-3 btn-action mr-1" data-toggle="tooltip" title="detail"><i class="material-icons left">edit</i>Edit</a> -->
                          {{-- <a class="btn btn-danger btn-action" data-toggle="tooltip" title="Delete" data-confirm="Apakah anda yakin?| Data ini akan terhapus. Lanjutkan ?" data-confirm-yes="hapus({{ $i->id }})"><i class="material-icons left">delete_forever</i>Hapus</a> --}}
                          <a class="btn btn-danger btn-action" data-toggle="tooltip" onclick="hapus({{$i->id}})" title="Delete"><i class="material-icons left">delete_forever</i>Hapus</a>
                        </td>
                      </tr>
                  @endforeach
                </tbody>
                <tfoot>
                  <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Tanggal</th>
                    <th>Waktu Mulai</th>
                    <th>Waktu Selesai</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
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
<script src="{{asset('js/scripts/jadwal.js')}}"></script>
@endsection



