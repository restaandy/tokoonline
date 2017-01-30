
      <!-- /.row -->
      <!-- Main row -->
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
                                
              </div>
              </div>
              <div class="col-md-6">
                
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
       });  
      </script>