//AMBIL MODAL
document.addEventListener('DOMContentLoaded', function(){
  var elems = document.querySelectorAll('.modal');
  M.Modal.init(elems);
});

//tambah data
$('#form-tambah-data').on('submit', function(e){
  e.preventDefault();
  var actionUrl = $(this).attr('action');
  console.log('url', actionUrl);
  var formData = $(this).serialize();
  console.log('form', formData);

  $.ajax({
    url: actionUrl,
    type: 'POST',
    data: formData,
    success: function(res){
      Swal.fire({
        icon: 'success',
        title: 'Data berhasil ditambahkan',
        text:'Data siswa telah ditambahkan',
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
        title: 'Data tidak berhasil ditambahkan',
        text:'Data siswa tidak ditambahkan',
        confirmButtonText: 'OK'
      })
    }
  });
});

$(document).on('click', '.edit-link', function(e){
  e.preventDefault();
  var id = $(this).data('id');
  // console.log(id);
  $.ajax({
    url:'api/siswa/'+id,
    type: 'GET',
    success: function(res){
      var jk = res.data.jenis_kelamin;
      console.log(res);
      $('#nis-edit').val(res.data.nis);
      $('#nama-edit').val(res.data.nama);
      $('#jenis_kelamin-edit').val(res.data.jenis_kelamin);
      
      //checked jenis kelamin
      $('#radio-male').prop('checked', jk === 'Laki-Laki' ? true : false);
      $('#radio-female').prop('checked', jk === 'Perempuan' ? true : false);

      $('#kelas-edit').val(res.data.kelas);
      $('#kode-edit').val(res.data.kode);
      $('#kartu-edit').val(res.data.kartu);
      ('#foto-edit').val(res.data.foto);
      
      $('#edit-data').modal('open');
      $('#form-edit-siswa').attr('action', 'api/siswa/'+res.data.id);
    }
  });

  $('#form-edit-siswa').on('submit', function(event) {
    event.preventDefault(); //agar form submit tidak default

    var actionUrl = $(this).attr('action'); //dapatkan url action dari form
    
    $.ajax({
      url: actionUrl,
      type: 'POST',
      data: $(this).serialize(),
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