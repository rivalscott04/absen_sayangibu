//AMBIL MODAL
document.addEventListener('DOMContentLoaded', function(){
  var elems = document.querySelectorAll('.modal');
  M.Modal.init(elems);
});

//tambah data
$('#form-tambah-data').on('submit', function(e){
  e.preventDefault();
  // var actionUrl = $(this).attr('action');
  // let actionUrl = 'api/mesin/';
  let actionUrl = 'api/mesin/';
  let formData = new FormData(this);
  console.log('form', formData);

  $.ajax({
    url: actionUrl,
    type: 'POST',
    data: formData,
    contentType: false,
    processData: false,
    success: function(res){
      Swal.fire({
        icon: 'success',
        title: 'Data berhasil ditambahkan',
        text:'Data mesin telah ditambahkan',
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
        text:'Data mesin tidak ditambahkan',
        confirmButtonText: 'OK'
      })
    }
  });
});

//MENGHAPUS DATA
function hapus($id){
    var url = "mesin/"+$id;
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