//AMBIL MODAL
document.addEventListener('DOMContentLoaded', function(){
  var elems = document.querySelectorAll('.modal');
  M.Modal.init(elems);
});

//MENGHAPUS DATA
function hapus($id){
    var url = "siswa/"+$id;
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