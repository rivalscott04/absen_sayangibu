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
<div class="col s12">
  <a href="/" class="breadcrumb">Home</a>
  <a href="#" class="breadcrumb">Attendance</a>
  <a href="/siswa" class="breadcrumb">Siswa</a>
</div>
<br>
<div class="section section-data-tables">
  <div class="card">
    <div class="card-content">
      <h5 class="mb-0 mt-0" style="font-weight:bold">DATA SISWA</h5>
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
            <a class= "waves-effect waves-light btn gradient-45deg-purple-deep-purple modal-trigger" href="#import-siswa">
              <i class="material-icons left">file_download</i> Import
            </a>
          </span>

          <!-- import siswa -->
          <div id="import-siswa" class="modal">
            <div class="modal-content">
              <h4>Import Siswa</h4>
              <form action="{{ route('import-excel') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="form-group mb-4">
                      <div class="custom-file text-left">
                          <input type="file" name="file" class="custom-file-input" id="customFile">
                          <label class="custom-file-label" for="customFile">Choose file</label>
                      </div>
                  </div>
                  <button class="btn btn-primary">Import Users</button>
              </form>
            </div>
          </div>
          <!-- tambah data -->
          <div id="tambah-data" class="modal">
            <div class="modal-content">
              <h4>Tambah Siswa</h4>
              <form id="form-tambah-data" enctype="multipart/form-data">
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
                    <div class="btn">
                      <span>Photo</span>
                      <input type="file" name="foto" id="foto">
                    </div>
                    <div class="file-path-wrapper">
                      <input class="file-path validate" type="text" placeholder="Upload a photo">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col s12">
                    <p>Gender</p>
                    <p>
                      <label>
                        <input class="validate" required name="jenis_kelamin" value="Laki-Laki" id="jenis_kelamin" type="radio" checked />
                        <span>Laki-Laki</span>
                      </label>
                    </p>
  
                    <label>
                      <input class="validate" required name="jenis_kelamin" value="Perempuan" id="jenis_kelamin" type="radio" />
                      <span>Perempuan</span>
                    </label>
                    <div class="input-field">
                    </div>
                  </div>
                </div>
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

          <!-- edit data -->
          <div id="edit-data" class="modal">
            <div class="modal-content">
              <h4>Edit Data</h4>
              <form id="form-edit-siswa" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- @method('PUT') -->
                <div class="row">
                  <div class="input-field col m6 s12">
                    <input id="id-edit" name="id-edit" type="text" required hidden>
                    <input id="nis-edit" placeholder="nis" name="nis" type="text" value="" required>
                    <label for="nis">Nomor Induk Sekolah</label>
                  </div>
                  <div class="input-field col m6 s12">
                    <input id="nama-edit" placeholder="nama" name="nama" type="text" required>
                    <label for="nama">Nama Siswa</label>
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col m6 s12">
                    <select name="kelas" id="kelas-edit">
                      {{-- <option value=""></option> --}}
                      <option value="VII">VII</option>
                      <option value="VIII">VIII</option>
                      <option value="IX">IX</option>
                    </select>
                    <label for="kelas">Kelas</label>
                  </div>
                  <div class="input-field col m6 s12">
                    <input id="kode-edit" placeholder="kode" name="kode" type="text" value="" required>
                    <label for="kode">Kode</label>
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col m6 s12">
                    <input id="kartu-edit" placeholder="kartu" name="kartu" type="text" value="" required>
                    <label for="kartu">Kartu</label>
                  </div>
                  <div class="col m6 s12 file-field input-field">
                    <div class="btn float-right">
                      <i class="material-icons left">add_a_photo</i>
                      <span>Photo</span>
                      <input type="file" name="foto_edit">
                    </div>
                    <div class="file-path-wrapper">
                      <input class="file-path validate" type="text" id="foto-name">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col s12">
                    <p>Gender</p>
                    <p>
                      <label>
                        <input class="validate" required name="jenis_kelamin" value="Laki-Laki" id="radio-male" type="radio"/>
                        <span>Laki-Laki</span>
                      </label>
                    </p>
  
                    <label>
                      <input class="validate" required name="jenis_kelamin" value="Perempuan" id="radio-female" type="radio" />
                      <span>Perempuan</span>
                    </label>
                    <div class="input-field">
                    </div>
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
                    <th>NIS</th>
                    <th>Nama</th>
                    <th>Jenis Kelamin</th>
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
                        <td>{{$i->jenis_kelamin}}</td>
                        <td>{{$i->kelas}}</td>
                        <td>{{$i->kode}}</td>
                        <td>{{$i->kartu}}</td>
                        <td>
                          <a href="#" class="btn orange darken-3 mr-1 edit-link" data-id="{{$i->id}}"><i class="material-icons">edit</i></a>
                          <!-- <a href="{{url('siswa').'/'.$i->id}}" class="btn btn-primary orange darken-3 btn-action mr-1" data-toggle="tooltip" title="detail"><i class="material-icons left">edit</i>Edit</a> -->
                          {{-- <a class="btn btn-danger btn-action" data-toggle="tooltip" title="Delete" data-confirm="Apakah anda yakin?| Data ini akan terhapus. Lanjutkan ?" data-confirm-yes="hapus({{ $i->id }})"><i class="material-icons left">delete_forever</i></a> --}}
                          <a class="btn btn-danger btn-action" data-toggle="tooltip" onclick="hapus({{$i->id}})" title="Delete"><i class="material-icons">delete_forever</i></a>
                        </td>
                      </tr>
                  @endforeach
                </tbody>
                <tfoot>
                  <tr>
                    <th>No</th>
                    <th>NIS</th>
                    <th>Nama</th>
                    <th>Jenis Kelamin</th>
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



