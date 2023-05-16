{{-- layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Data Siswa')

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
          <span class="card-title">
            <a class= "waves-effect waves-light btn gradient-45deg-light-blue-cyan modal-trigger" href="#tambah-data">
              <i class="material-icons left">add_box</i> Tambah
            </a>
          </span>
          <div id="tambah-data" class="modal">
            <div class="modal-content">
              <h4>Tambah Siswa</h4>
              <form id="form-tambah-data" method="POST" action="{{route('siswa.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                  <div class="input-field col m6 s12">
                    <input id="nis" name="nis" type="text" required>
                    <label for="nis">Nomor Induk Sekolah</label>
                  </div>
                  <div class="input-field col m6 s12">
                    <input id="nama" name="nama" type="text" required>
                    <label for="nama">Nama Siswa</label>
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col m6 s12">
                    <select name="kelas" id="kelas">
                      <option value="" disabled selected>Pilih Kelas</option>
                      <option value="VII">VII</option>
                      <option value="VIII">VIII</option>
                      <option value="IX">IX</option>
                    </select>
                    <label for="kelas">Kelas</label>
                  </div>
                  <div class="input-field col m6 s12">
                    <input id="kode" name="kode" type="text" required>
                    <label for="kode">Kode</label>
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col m6 s12">
                    <input id="kartu" name="kartu" type="text" required>
                    <label for="kartu">Kartu</label>
                  </div>
                  <div class="col m6 s12 file-field input-field">
                    <div class="btn float-right">
                      <i class="material-icons left">add_a_photo</i>
                      <span>Photo</span>
                      <input type="file" name="foto">
                    </div>
                    <div class="file-path-wrapper">
                      <input class="file-path validate" type="text">
                    </div>
                  </div>
                </div>
                {{-- <div class="row">
                  <div class="col s12">
                    <p>Gender</p>
                    <p>
                      <label>
                        <input class="validate" required name="gender0" type="radio" checked />
                        <span>Male</span>
                      </label>
                    </p>
  
                    <label>
                      <input class="validate" required name="gender0" type="radio" />
                      <span>Female</span>
                    </label>
                    <div class="input-field">
                    </div>
                  </div>
                </div> --}}
                <div class="row">
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
          <h4 class="card-title">Page Length Options</h4>
          <div class="row">
            <div class="col s12">
              <table id="page-length-option" class="display">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>NIS</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>Kode</th>
                    <th>Kartu</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($data as $i)
                      <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$i->nis}}</td>
                        <td>{{$i->nama}}</td>
                        <td>{{$i->kelas}}</td>
                        <td>{{$i->kode}}</td>
                        <td>{{$i->kartu}}</td>
                        <td>
                          <a href="{{url('siswa').'/'.$i->id}}" class="btn btn-primary orange darken-3 btn-action mr-1" data-toggle="tooltip" title="detail"><i class="material-icons left">edit</i>Edit</a>
                          {{-- <a class="btn btn-danger btn-action" data-toggle="tooltip" title="Delete" data-confirm="Apakah anda yakin?| Data ini akan terhapus. Lanjutkan ?" data-confirm-yes="hapus({{ $i->id }})"><i class="material-icons left">delete_forever</i>Hapus</a> --}}
                          <a class="btn btn-danger btn-action" data-toggle="tooltip" onclick="hapus({{$i->id}})" title="Delete"><i class="material-icons left">delete_forever</i>Hapus</a>
                        </td>
                      </tr>
                  @endforeach
                </tbody>
                <tfoot>
                  <tr>
                    <th>No</th>
                    <th>NIS</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>Kode</th>
                    <th>Kartu</th>
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
<script src="{{asset('js/scripts/siswa.js')}}"></script>
@endsection



