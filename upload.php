<?php
  $folder="uploads";
  if (!file_exists('uploads')) {
      mkdir('uploads', 0777);
  }
  $move = move_uploaded_file($_FILES["upload_file"]["tmp_name"], $folder . "/" . $_FILES["upload_file"]["name"]);
  if($move){
       echo "File uploaded successfully..";
     }else{
      echo "Uploading failed!";
    }
 ?>
