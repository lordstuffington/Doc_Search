<?php
include ("model.php");
$readyForUpload = 1;
$email = $_POST["email"];
$upload_dir = "../images/profilePictures/";
$uploadedFile = $upload_dir . $email . basename($_FILES["fileToUpload"]["name"]);
$uploadFileType = strtolower(pathinfo($uploadedFile,PATHINFO_EXTENSION));

// Check if file is an image
$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
if($check) {
  $readyForUpload = 0;
  } else {
    $readyForUpload = 1;
  }

// Check file size
  if ($_FILES["fileToUpload"]["size"] > 500000) {
    $readyForUpload = 1;
  }

// Check if file already exists
if (file_exists($uploadedFile)) {
  $readyForUpload = 1;
}

// Allow certain file formats
if($uploadFileType != "jpg" AND $uploadFileType != "png" AND $uploadFileType != "jpeg") {
  $readyForUpload = 1;
}

if($readyForUpload == 0){
  if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $uploadedFile)){
      MyPractice::setPracticePicture(substr($uploadedFile,3,strlen($uploadedFile)-3),$_POST["email"]);
  }
}
header('Location:../practiceInformation.php');
?>
