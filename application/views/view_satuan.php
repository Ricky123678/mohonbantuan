<div class="row">
    <div class="col-md-12">
      <div class="box box-danger">
        <div class="box-header with-border color-header">
          <h3 class="box-title"><i class="fa fa-th"></i> Data Satuan Barang</h3>
          <div class="box-tools pull-right">
           <a class="btn btn-default btn-sm" href="<?php echo base_url('Satuan'); ?>">
           <span class="fa fa-refresh"></span> Refresh</a>
           <button type="button" class="btn btn-sm btn-success btnTambah" id="btnTambah">
              <span class="fa fa-plus"></span> Tambah</button>
         </div>
       </div>
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
              <table class="table table-bordered table-condensed" id="mydata">
              <thead>
                <tr>
                  <th style='width:30px;text-align: center;'>#No</th>
                  <th>Satuan Barang</th>
                  <th style='width:120px;text-align: center;'>Action</th>
                </tr>
              </thead>
              <tbody id="tbl_data">
              </tbody>
            </table>
        </div>
      </div>
    </div>
    </div>
  </div>
</div>

<!-- Modal Satuan-->
<div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" id="formModal">Tambah Satuan Barang</h4>
        </div>
        <div class="modal-body">
          <form action="" method="post" id="form_add">
            <input type="hidden" id="id_satuan" name="id_satuan">
            <div class="form-group">
              <label>Nama Satuan</label>
              <input type="text" class="form-control" name="nama_satuan" id="nama_satuan" placeholder="Nama satuan">
            </div>
            <div class="model-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
              <button type="button" class="btn btn-primary" id="btnSimpan"
              data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing ">Simpan Data</button>
            </div>
          </form>
        </div>
      </div>
    </div>
</div>
<!-- End Modal Add Satuan-->

<script type="text/javascript">
  $(document).ready(function(){
    var btnEdit=false;
    tampil_data();
    //Menampilkan Data di tabel
    function tampil_data(){
      $.ajax({
        url: '<?php echo base_url(); ?>satuan/tampilkanData',
        type: 'POST',
        dataType: 'json',
        success: function(response){
          var i;
          var no = 0;
          var html = "";
          for(i=0; i<response.length ; i++){
            no++;
            html = html + '<tr>'
            + '<td >' + no  + '</td>'
            + '<td>' + response[i].nama_satuan + '</td>'
            + '<td><center>' + '<span><button edit-id="'+response[i].id_satuan+
              '" class="btn btn-success btn-xs btn_edit"><i class="fa fa-edit"></i> Edit</button><button style="margin-left: 5px;" data-id="'
              +response[i].id_satuan+'" class="btn btn-danger btn-xs btn_hapus"><i class="fa fa-trash"></i> Hapus</button></span>'  + '</td>'
            + '</tr>';
          }
          $("#tbl_data").html(html);
          $('#mydata').DataTable();
        },
        error: function (xhr, ajaxOptions, thrownError) {
          alert(xhr.status);
          alert(thrownError);
        }
      });
    }

    //Memanggil Modal Satuan
    $(document).on("click", "#btnTambah", function(e){
      e.preventDefault();
      bEdit=false;
      $('#form_add')[0].reset(); // reset form on modals
      $('.form-group').removeClass('has-error'); //clear error class
      $('.help-block').empty(); // clear error string
      $('#formModal').modal('show'); // Tampilkan Bootstrap Modal
      $('.modal-title').text('Tambah Satuan Barang'); //Set Judul modal
    });

    //Edit Satuan
    $("tbl_data").on('click','.btn_edit1',function(){
      var id_satuan = $(this).attr('edit-id');
      bEdit=true;
      $.ajax({
        url: '<?php echo base_url(); ?>satuan/tampilkanDataByID',
        type: 'POST',
        data: {id_satuan:id_satuan},
        dataType: 'json',
        success: function(response){
          $('#form_add')[0].reset(); // reset forms on modal
          $('.form-group').removeClass('has-error'); // clear error class
          $('.help-block').empty(); // clear error string
          $('.modal-title').text('Edit Satuan Barang'); // Set Title to Bootstrap modal title
          $('input[name="nama_satuan"]').val(response.nama_satuan);
          $('input[name="id_satuan"]').val(response.id_satuan);
          $("#formModal").modal('show');
        }
      })
    });

    $("#tbl_data").on('click','.btn_edit',function(){
      var id_satuan = $(this).attr('edit-id');
      bEdit=true;
      $.ajax({
        url: '<?php echo base_url(); ?>satuan/tampilkanDataByID',
        type: 'POST',
        data: {id_satuan:id_satuan},
        dataType: 'json',
        success: function(response){
          $('#form_add')[0].reset(); // reset form on modals
          $('.form-group').removeClass('has-error'); // clear error class
          $('.help-block').empty(); // clear error string
          $('.modal-title').text('Edit Satuan Barang'); // Set Title to Bootstrap modal title
          $('input[name="nama_satuan"]').val(response.nama_satuan);
          $('input[name="id_satuan"]').val(response.id_satuan);
          $("#formModal").modal('show');
        }
      })
    });


    //Kirim Data Proses Save/Update ke Controller
    $(document).on("click", "#btnSimpan1", function(e){
      e.preventDefault();
      var $this = $(this);
      var id_satuan = $("#id_satuan").val();
      var nama_satuan = $("$nama_satuan").val();
      // Periksa apakah tombol edit?
      if (bEdit){
        var sURL='<?php echo base_url(); ?>satuan/perbaruiData';
      }else{
        var sURL='<?php echo base_url(); ?>satuan/tambahData';
      }
      $.ajax({
        url: sURL,
        type: "post",
        dataType: "json",
        data: {id_satuan:id_satuan, nama_satuan:nama_satuan},
        beforeSend: function () {
          $this.button('loading');
        },
        complete: function () {
          $this.button('reset');
        },
        success: function(data){
          if (data.response == "success") {
            $("#form_add")[0].reset();
            $('.form-group').removeClass('has-error'); // clear error class
            $('.help-block').empty(); // clear error string
            $('#formModal').modal('hide');
            Swal.fire({
              text: 'Data berhasil di Simpan',
              icon: 'success',
              title: 'Saving success',
              showConfirmButton: false,
              timer: 1500
            });
            $('#mydata').dataTable({"bDestroy": true}).fnDestroy();
            tampil_data();
          }else{
            Swal.fire('Error!','Ops! <br>' + data.message, 'error');
          }
        }
      });
    });

    $(document).on("click", "#btnSimpan", function(e){
      e.preventDefault();
      var $this = $(this);
      //buat variabel untuk menampung nilai modal
      var id_satuan = $("#id_satuan").val();
      var nama_satuan = $("#nama_satuan").val();
      //Periksa apakah tombol edit ?
      if (bEdit){
        //Jika Edit, Update Data
        var sURL='<?php echo base_url(); ?>satuan/perbaruiData';
      }else{
        var sURL='<?php echo base_url(); ?>satuan/tambahData';
      }
      $.ajax({
          url: sURL,
          type: "post",
          dataType: "json",
          data: {id_satuan:id_satuan, nama_satuan:nama_satuan},
          beforeSend: function () {
            $this.button('loading');
          },
          complete: function () {
            $this.button('reset');
          },
          success: function(data){
            if (data.responce == "success") {
              $("#form_add")[0].reset();
              $('.form-group').removeClass('has-error'); // clear error class
              $('.help-block').empty(); // clear error string
              $('#formModal').modal('hide');
              Swal.fire({
                text: 'Data berhasil di Simpan',
                icon: 'success',
                title: 'Saving Succes',
                showConfirmButton: false,
                timer: 1500
              });
              $('#mydata').dataTable({"bDestroy": true}).fnDestroy();
              tampil_data();
            }else{
              Swal.fire('Error!','Ops! <br>' + data.message,'error');
            }
          }
        });
    });
    //Hapus data
    $("#tbl_data").on('click', '.btn_hapus',function(e){
      e.preventDefault();
      var id_satuan = $(this).attr('data-id');
      Swal.fire({
        title: 'Hapus Data?',
        text: 'Anda Yakin menghapus Data Satuan ini?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        cancelButtonText: 'Tidak',
        confirmButtonText: 'Ya',
        showLoaderOnConfirm: true,
        preConfirm: () => {
          return new Promise(function(resolve,reject) {
            $.ajax({
              url: '<?php echo base_url(); ?>satuan/hapusData',
              type: 'POST',
              dataType: "json",
              data: {id_satuan: id_satuan}
            })
            .done(function(data) {
              resolve(data)
            })
            .fail(function() {
              reject()
            });
          })
        },
        allowOutsideClick: () => !swal.isLoading()
      }).then((result) => {
        if (result.value) {

         $('#mydata').dataTable({"bDestroy": true}).fnDestroy();
          tampil_data();
          Swal.fire({
            icon: 'success',
            title: 'Data Telah Berhasil di Hapus',
            showConfirmButton: false,
            timer: 1500
          })
        }
      })
    });
  });
</script>   
