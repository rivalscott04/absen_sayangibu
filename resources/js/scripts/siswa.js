//AMBIL MODAL
document.addEventListener('DOMContentLoaded', function(){
  var elems = document.querySelectorAll('.modal');
  M.Modal.init(elems);
});

//tambah data
// $('#form-tambah-data').on('submit', function(e){
//   e.preventDefault();
//   // var actionUrl = $(this).attr('action');
//   let actionUrl = 'api/tambahsiswa/';
//   let formData = new FormData(this);
//   console.log('form', formData);

//   $.ajax({
//     url: actionUrl,
//     type: 'POST',
//     data: formData,
//     contentType: false,
//     processData: false,
//     success: function(res){
//       Swal.fire({
//         icon: 'success',
//         title: 'Data berhasil ditambahkan',
//         text:'Data siswa telah ditambahkan',
//         confirmButtonText: 'OK'
//       }).then((result) => {
//         if(result.isConfirmed){
//           location.reload();
//         }
//       });
//     },
//     error: function(xhr, status, error){
//       Swal.fire({
//         icon: 'error',
//         title: 'Data tidak berhasil ditambahkan',
//         text:'Data siswa tidak ditambahkan',
//         confirmButtonText: 'OK'
//       })
//     }
//   });
// });

$('#form-tambah-data').on('submit', async function(e){
  e.preventDefault();
  let actionUrl = 'api/tambahsiswa/';
  let formData = new FormData(this);

  try {
    const response = await fetch(actionUrl, {
      method: 'POST',
      body: formData,
    });

    if (response.ok) {
      const res = await response.json();
      Swal.fire({
        icon: 'success',
        title: 'Data berhasil ditambahkan',
        text: res.message, // Asumsi server mengirimkan pesan sukses
        confirmButtonText: 'OK'
      }).then((result) => {
        if(result.isConfirmed){
          location.reload();
        }
      });
    } else {
      // Handle HTTP status code secara spesifik (misal: 400, 500, dll)
      const error = await response.json();
      Swal.fire({
        icon: 'error',
        title: 'Data tidak berhasil ditambahkan',
        text: error.message, // Asumsi server mengirimkan pesan error
        confirmButtonText: 'OK'
      });
    }
  } catch (error) {
    console.error('Error:', error);
    Swal.fire({
      icon: 'error',
      title: 'Terjadi Kesalahan',
      text: 'Tidak dapat menghubungi server',
      confirmButtonText: 'OK'
    });
  }
});


var idEdit
$(document).on('click', '.edit-link', function(e){
  e.preventDefault();
  let id = $(this).data('id');
  idEdit = id
  // console.log(id);
  $.ajax({
    url:'api/siswa/'+id,
    type: 'GET',
    success: function(res){
      let jk = res.data.jenis_kelamin;
      console.log(res);
      $('#id-edit').val(res.data.id);
      $('#nis-edit').val(res.data.nis);
      $('#nama-edit').val(res.data.nama);
      $('#jenis_kelamin-edit').val(res.data.jenis_kelamin);
      
      //checked jenis kelamin
      $('#radio-male').prop('checked', jk === 'Laki-Laki' ? true : false);
      $('#radio-female').prop('checked', jk === 'Perempuan' ? true : false);

      $('#kelas-edit').val(res.data.kelas);
      $('#kode-edit').val(res.data.kode);
      $('#kartu-edit').val(res.data.kartu);
      $('#foto-name').val(res.data.foto);
      
      $('#edit-data').modal('open');
      $('#form-edit-siswa').attr('action', 'api/siswa/'+idEdit);
    }
  });

  $('#form-edit-siswa').on('submit', function(event) {
    event.preventDefault(); //agar form submit tidak default
    // id = document.getElementById('#id-edit').val();
    // console.log(idEdit);
    // let id = idEdit;
    var actionUrl = $(this).attr('action'); //dapatkan url action dari form
    // var actionUrl = "{{url('api/siswa')}}"+"/"+id; //dapatkan url action dari form
    console.log(actionUrl);
    let formData = new FormData(this);
    
    $.ajax({
      url: actionUrl,
      type: 'POST',
      data: formData,
      contentType: false,
      processData: false,
      success: function(res){
        Swal.fire({
          icon: 'success',
          title: 'Data berhasil di perbaharui',
          text:'Data siswa telah diperbaharui',
          confirmButtonText: 'OK'
        }).then((result) => {
          if(result.isConfirmed){
            location.reload();
          }
        });
      },
      error: function(xhr, status, error){
        Swal.fire({
          icon: 'error',
          title: 'Data tidak berhasil di perbaharui',
          text:'Data siswa tidak diperbaharui',
          confirmButtonText: 'OK'
        })
      }
    });
  });
});

//MENGHAPUS DATA
function hapus($id){
    var url = "api/siswa/"+$id;
    console.log(url);
    Swal.fire({
      title: "Anda Yakin ?",
      text: "Anda tidak bisa mengembalikan data!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonText: "Ya, Hapus!",
      cancelButtonText: "Batal",
      reverseButtons: true
    }).then((result) => {
      if(result.isConfirmed){
        $.ajax({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url: url,
          method: 'DELETE',
          success:function(xhr, ajaxOptions, thrownError)
          {
            Swal.fire(
              'Berhasil', 
              'Data Terhapus', 
              'success'
            ).then(()=>{
              location.reload();
            });
  
            // setTimeout(function() {
            //   location.reload();
            // },1000)
          },
            error: function() {
          }
        });      
      } else if(result.dismiss === Swal.DismissReason.cancel) {
        Swal.fire(
          'Cancelled',
          'Delete action has been cancelled.',
          'error'
        );
      }
    })
}