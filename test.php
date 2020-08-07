<?php
include ("uploadFunctions.php");
    if (isset($_POST["submit"])){
      TestClass::uploadFile($_POST["fileToUpload"]);
    }
 ?>

<form action="" method = "post" enctype="multipart/form-data">
  <input type="file" name="fileToUpload">
  <button type="submit" name="submit">Upload</button>
</form>
