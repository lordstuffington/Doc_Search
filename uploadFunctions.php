<?php
class Testclass{
  public static function uploadFile($file){
    var_dump($file);
    echo 'es passiert etwas';
       $upload_dir = "uploads/";
       $uploadedFile = $upload_dir . basename($_FILES["fileToUpload"]["name"]);
       if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $uploadedFile)){
           echo 'File successfully uploaded';
       }else{
           echo 'Error';
       }
  }
}
 ?>
