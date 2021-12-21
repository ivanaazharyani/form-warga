 <!DOCTYPE html>
 <html>
  <head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>Form</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
 <style type="text/css">
 body{ 
    padding: 20px 
 }
 #drop_zone {
    background-color: #FFE3E3;
    border: #B980F0 5px dashed;
    width: 30%;
    padding : 10px 0;
 }
 #drop_zone p {
    font-size: 20px;
    text-align: center;
 }
 #btn_upload, #selectfile {
    display: none;
 }
 </style>
 <body>
 <center><h2>Form Warga</h2></center>
 <div class="login">
		<form action="#" method="POST" onSubmit="validasi()">
			<div>
				<label>Nama Lengkap:</label>
				<input type="text" name="nama" id="nama" />
			</div>
			<div>
				<label>NIK:</label>
				<input type="nik" name="nik" id="nik" />
			</div>
			<div>
				<label>Nomor Kartu Keluarga:</label>
				<input type="nkk" name="nkk" id="nkk" />
			</div>
			<div>
 			<label>Upload Foto KTP:</label>
 				<div id="drop_zone">
    			<p>Drop file here</p>
    			<p>or</p>
    			<p><button type="button" id="btn_file_pick" class="btn btn-primary"><span class="glyphicon glyphicon-folder-open"></span>  Select File</button></p>
    			<p id="file_info"></p>
    			<p><button type="button" id="btn_upload" class="btn btn-primary"><span class="glyphicon glyphicon-arrow-up"></span>  Upload To Server</button></p>
    			<input type="file" id="selectfile">
    			<p id="message_info"></p>
 				</div>
			</div>
			<div>
 			<label>Upload Foto Kartu Keluarga:</label>
 				<div id="drop_zone">
    			<p>Drop file here</p>
    			<p>or</p>
    			<p><button type="button" id="btn_file_pick" class="btn btn-primary"><span class="glyphicon glyphicon-folder-open"></span>  Select File</button></p>
    			<p id="file_info"></p>
    			<p><button type="button" id="btn_upload" class="btn btn-primary"><span class="glyphicon glyphicon-arrow-up"></span>  Upload To Server</button></p>
    			<input type="file" id="selectfile">
    			<p id="message_info"></p>
 				</div>
			</div>
			<div>
				<label>Umur:</label>
				<input type="umur" name="umur" id="umur" />
			</div>
			<div>
				<label>Jenis Kelamin:</label>
				<label><input type="radio" name="jenis_kelamin" value="laki-laki" checked /> Laki - Laki</label>
				<label><input type="radio" name="jenis_kelamin" value="perempuan" /> Perempuan</label>
			</div>
			<div>
				<label>Provinsi:</label>
				<select name="provinsi">
					<option value="Jawa Barat"> Jawa Barat</option>
					<option value="Sumatera Barat"> Sumatera Barat</option>
				</select>
			</div>
			<div>
				<label>Kab/Kota:</label>
				<input type="kota" name="kota" id="kota" />
			</div>
			<div>
				<label>Kecamatan:</label>
				<input type="Kecamatan" name="kecamatan" id="kecamatan" />
			</div>
			<div>
				<label>Kelurahan/Desa:</label>
				<input type="desa" name="desa" id="desa" />
			</div>
			<div>
				<label>Alamat:</label>
				<textarea cols="40" rows="5" name="alamat" id="alamat"></textarea>
			</div>
			<div>
				<label>RT:</label>
				<input type="rt" name="rt" id="rt" />
			</div>
			<div>
				<label>RW:</label>
				<input type="rw" name="rw" id="rw" />
			</div>
			<div>
				<label>Penghasilan Sebelum Pandemi:</label>
				<input type="sebelumpandemi" name="sebelumpandemi" id="sebelumpandemi" />
			</div>
			<div>
				<label>Penghasilan Setelah Pandemi:</label>
				<input type="setelahpandemi" name="setelahpandemi" id="setelahpandemi" />
			</div>
			<div>
				<label>Alasan Membutuhkan Bantuan:</label>
				<textarea cols="40" rows="5" name="alasan" id="alasan"></textarea>
			</div>
			
			<div>
				<input type="submit" value="Submit" class="tombol">
			</div>

 </form>
</div>

 <script>
 var fileobj;
 $(document).ready(function(){
    $("#drop_zone").on("dragover", function(event) {
         event.preventDefault();  
         event.stopPropagation();
        return false;
    });
    $("#drop_zone").on("drop", function(event) {
      event.preventDefault();  
      event.stopPropagation();
      fileobj = event.originalEvent.dataTransfer.files[0];
      var fname = fileobj.name;
      var fsize = fileobj.size;
     if (fname.length > 0) {
         document.getElementById('file_info').innerHTML = "File name : " + fname +' <br>File size : ' + bytesToSize(fsize);
      }
      document.getElementById('selectfile').files[0] = fileobj;
      document.getElementById('btn_upload').style.display="inline";
    });
    $('#btn_file_pick').click(function(){
      /*normal file pick*/
      document.getElementById('selectfile').click();
      document.getElementById('selectfile').onchange = function() {
      fileobj = document.getElementById('selectfile').files[0];
      var fname  = fileobj.name;
      var fsize = fileobj.size;
      if (fname.length > 0) {
         document.getElementById('file_info').innerHTML = "File name : " + fname +' <br>File size : ' + bytesToSize(fsize);
      }
      document.getElementById('btn_upload').style.display="inline";
      };
    });
    $('#btn_upload').click(function(){
      if(fileobj=="" || fileobj==null){
         alert("Please select a file");
         return false;
      }else{
         ajax_file_upload(fileobj);
      }
    });
 });
 
 function ajax_file_upload(file_obj) {
    if(file_obj != undefined) {
      var form_data = new FormData();                  
      form_data.append('upload_file', file_obj);
      $.ajax({
         type: 'POST',
         url: 'upload.php',
         contentType: false,
         processData: false,
         data: form_data,
         beforeSend:function(response) {
         $('#message_info').html("Uploading your file, please wait...");
         },
         success:function(response) {
         $('#message_info').html(response);
         alert(response);
         $('#selectfile').val('');
         }
      });
    }
 }
 function bytesToSize(bytes) {
    var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
    if (bytes == 0) return '0 Byte';
    var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
    return Math.round(bytes / Math.pow(1024, i), 2) + ' ' + sizes[i];
 }
 </script>
 </body>
 </html>
 
