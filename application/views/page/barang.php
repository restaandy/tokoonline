<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/select2/select2.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/dropzone/dropzone.css">      
      <div class="row">
        <!-- Left col -->
        <?php echo form_open('admin/simpan_barang',array("id"=>"formbarang","method"=>"post","enctype"=>"multipart/form-data")); ?>
        <section class="col-lg-12">
        <div class="box box-danger">
            <div class="box-header">
              <i class="fa fa-th"></i>
              <h3 class="box-title">Tambah Barang</h3>
            </div>
            <div class="box-body">
              <div class="col-md-5">
                <div class="row">
                <div class="form-group">
                <label>Nama Barang : </label>
                  <input class="form-control filter-text" name="nama_barang" type="text" required>
                </div>  
                <div class="form-group">
                <label>Kategori : </label>
                <select class="form-control select2" multiple="multiple" required name="kategori_barang[]" data-placeholder="pilih kategori barang" style="width: 100%;">
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
                <input class="form-control filter-number" name="harga_barang" type="text" required>
                <span class="input-group-addon"> , 00</span>
              </div>  
              <label>Jumlah Stock Barang : </label>
              <div class="form-group input-group">     
                <input class="form-control filter-number" name="stok_barang" type="text" required>
                <span class="input-group-addon"> Item</span>
              </div>
              <div class="form-group">
                <label>Status : </label>
                  <select class="form-control" name="status_barang" required>
                    <option value="">Status Barang</option>
                    <option value="1">Tersedia</option>
                    <option value="0">Belum Tersedia</option>
                  </select>
              </div>         
              
              </div>
              </div>
              <div class="col-md-7">
              <div class="form-group">
                <label>Deskripsi Singkat : </label>
                 <textarea class="form-control filter-text" name="deskripsi_barang" required></textarea>
              </div>
              <div class="form-group">
                <label>Keyword Pencarian : </label>
                 <input type="text" class="form-control filter-text" name="keyword_barang">
              </div>
              <div class="form-group">
                <label>Tag : <small>(Pisah dengan koma ex : mobil,motor)</small> </label>
                 <input type="text" class="form-control filter-text" name="tag_barang">
              </div>
              <div class="form-group">
                <label>Gambar Produk : <small>(Format file : jpg,jpeg,png)</small> </label>
                <div class="row margin dropzone">
                	
                </div>
                <div class="hide" id="inputgambar">
                  
                </div>
              </div>
                               
              </div>
              <div class="col-md-12">
              <div class="row">
                <div class="form-group">
                <label>Deskripsi Barang : </label>
                  <textarea class="textarea" name="keterangan_barang" placeholder="Place some text here" style="width: 100%; height: 245px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                </div> 
                </div>
              </div>
            </div>
            <div class="box-footer clearfix">
              <button type="submit" class="pull-right btn btn-primary">Tambah Barang
                <i class="fa fa-arrow-circle-right"></i></button>
            </div>
          </div>
        </section>
        <?php echo form_close(); ?>
        <!-- /.Left col -->
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->
      <script src="<?php echo base_url(); ?>assets/plugins/select2/select2.full.min.js"></script>
      <script src="<?php echo base_url(); ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
      <script src="<?php echo base_url(); ?>assets/plugins/dropzone/dropzone.js"></script>  
      <script>
      $(document).ready(function(){
         
         $('.filter-text').keypress(function(e){
            var txt = String.fromCharCode(e.which);
            //console.log(txt + ' : ' + e.which);
            if(!txt.match(/[A-Za-z0-9+#., ]/)&&e.which!=8) 
            {
                return false;
            }
         });
         $('.filter-number').keypress(function(e){
            var txt = String.fromCharCode(e.which);
            //console.log(txt + ' : ' + e.which);
            if(!txt.match(/[0-9+#.]/)&&e.which!=8) 
            {
                return false;
            }
         });
      $(".select2").select2(); 
      $(".textarea").wysihtml5();
      var myDropzone = new Dropzone(".dropzone", {
      	url:'<?php echo base_url(); ?>admin/upload_image',
        renameFilename: function (filename) {
        	filename=filename.replace(" ", "-");
            return "1_"+filename;
        },
        removedfile:function(file){
        	var _ref;
        	var filename=$(file.previewTemplate).children('.newnamefile').text();
        	$.post('<?php echo base_url(); ?>admin/remove_image',{filename:filename},function(data,status){
        		if(status=="success"){
        			if(data=="berhasil"){
        				alert("Terhapus");
        				if (file.previewElement) {
				          if ((_ref = file.previewElement) != null) {
                        $(".imageupload").each(function(){
                            if($(this).val()==filename){
                              $(this).remove();
                            }
                        });
				            _ref.parentNode.removeChild(file.previewElement);
				          }
				        }
			        	return myDropzone._updateMaxFilesReachedClass();
        			}else{
        				alert("gagal hapus gambar dari server"+data);
        			}
        		}else{
        			alert("gagal hapus gambar dari server n"+data);
        		}
        	});            	
        },
        success: function(file,responseText,e) {
          if (file.previewElement) {
            $(file.previewTemplate).append('<span class="newnamefile" style="display:none;">'+responseText+'</span>'); 
            $("#inputgambar").append("<input type='hidden' class='imageupload' name='img[]' value='"+$(file.previewTemplate).children('.newnamefile').text()+"'>");
            //console.log($(file.previewTemplate).children('.newnamefile').text());
            return file.previewElement.classList.add("dz-success");
          }
        },
        dictRemoveFileConfirmation:"yakin hapus foto ?",
        maxFiles:5
      });

    });  
      </script>
