<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/select2/select2.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">      
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-12">
        <div class="box box-danger">
            <div class="box-header">
              <i class="fa fa-th"></i>
              <h3 class="box-title">Tambah Barang</h3>
            </div>
            <div class="box-body">
              <div class="col-md-4">
                <div class="row">
                <div class="form-group">
                <label>Nama Barang : </label>
                  <input class="form-control filter-text" type="text">
                </div>  
                <div class="form-group">
                <label>Kategori : </label>
                <select class="form-control select2" multiple="multiple" data-placeholder="pilih kategori barang" style="width: 100%;">
                  <option>Alabama</option>
                  <option>Alaska</option>
                  <option>California</option>
                  <option>Delaware</option>
                  <option>Tennessee</option>
                  <option>Texas</option>
                  <option>Washington</option>
                </select>
              </div>
              <label>Harga : </label>
              <div class="form-group input-group">     
                <span class="input-group-addon">Rp. </span>
                <input class="form-control filter-number" type="text">
                <span class="input-group-addon"> , 00</span>
              </div>  
              <label>Jumlah Stock Barang : </label>
              <div class="form-group input-group">     
                <input class="form-control filter-number" type="text">
                <span class="input-group-addon"> Item</span>
              </div>
              <div class="form-group">
                <label>Status : </label>
                  <select class="form-control">
                    <option value="">Status Barang</option>
                    <option value="1">Tersedia</option>
                    <option value="0">Belum Tersedia</option>
                  </select>
              </div>         
              
              </div>
              </div>
              <div class="col-md-8">
                <div class="form-group">
                <label>Deskripsi Barang : </label>
                  <textarea class="textarea" placeholder="Place some text here" style="width: 100%; height: 245px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                </div>                
              </div>
              <div class="col-md-12">
              <div class="row">
                <div class="form-group">
                <label>Gambar Barang : </label>
                 
                </div>
                </div>
              </div>
            </div>
            <div class="box-footer clearfix">
              <button type="button" class="pull-right btn btn-default" id="sendEmail">Tambah
                <i class="fa fa-arrow-circle-right"></i></button>
            </div>
          </div>
        </section>
        <section class="col-lg-12">

          <!-- quick email widget -->
          <div class="box box-info">
            <div class="box-header">
              <i class="fa fa-th"></i>
              <h3 class="box-title">Daftar Data Barang</h3>
            </div>
            <div class="box-body">
              
            </div>
            <div class="box-footer clearfix">
              <button type="button" class="pull-right btn btn-default" id="sendEmail">Tambah
                <i class="fa fa-arrow-circle-right"></i></button>
            </div>
          </div>

        </section>
        <!-- /.Left col -->
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->
      <script src="<?php echo base_url(); ?>assets/plugins/select2/select2.full.min.js"></script>
      <script src="<?php echo base_url(); ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
      <script>
      $(document).ready(function(){
         $('.filter-text').keypress(function(e){
            var txt = String.fromCharCode(e.which);
            console.log(txt + ' : ' + e.which);
            if(!txt.match(/[A-Za-z0-9+#.]/)&&e.which!=8) 
            {
                return false;
            }
         });
         $('.filter-number').keypress(function(e){
            var txt = String.fromCharCode(e.which);
            console.log(txt + ' : ' + e.which);
            if(!txt.match(/[0-9+#.]/)&&e.which!=8) 
            {
                return false;
            }
         });
      $(".select2").select2(); 
      $(".textarea").wysihtml5();
    
    });  
      </script>
