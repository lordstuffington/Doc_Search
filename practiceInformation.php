<?php
include ('includes\headerLogedIn.php');
include ('includes\model.php');

//Redirect to index.php, if session isn't set
session_start();
if(!isset($_SESSION['userid'])){
    die(Header("Location:index.php"));
}

//Logout
if(isset($_POST['btnlogout'])){
  session_destroy();
  header('Location:index.php');
}

if(isset($_POST["btn-changePicture"])){
  $practiceInformation[10] = " ";
}

//Get Practice information
$practiceInformation = MyPractice::getPracticeInformationByEmail($_SESSION['userid']);
?>

<body class="bg-light" onload="showPicture();">
  <div class="container pb-4">
    <div class="row">
      <div class="col-1 bg-dark">
        <div class="container text-center float-center">
          <div class="row pl-2 pt-4">
            <a href="dashboard.php"><img src="images\iconDashboard.svg" alt="Dashboard Icon" style="height: 50px; width: 50px"></a>
          </div>
          <div class="row pl-2 pt-4">
            <a href="shareDates.php"><img src="images\iconCalendar.svg" alt="Calendar Icon" style="height: 50px; width: 50px">
          </div>
          <div class="row pl-2 pt-4">
            <a href="practiceInformation.php"><img src="images\iconContact.svg" alt="Contact Icon" style="height: 50px; width: 50px;"></a>
          </div>
        </div>
      </div>
      <div class="col-11">
        <div class="row">
          <div class="col-12 mt-2">
            <u>
              <h3> Informationen </h3>
            </u>
          </div>
        </div>
        <hr />
        <div class="row">
          <div class="col-8">
            <form action="" method="post">
              <div class="row">
                <div class="col-6">
                  <u>
                    <h5>Über Ihre Praxis</h5>
                  </u>
                  <br>
                  <div class="form-group">
                    <input type="text" class="form-control" name="department" placeholder="Fachbereich" value="<?php echo $practiceInformation[1];?>">
                    <br>
                    <input type="text" class="form-control" name="address" placeholder="Straße, Hausnummer" value="<?php echo $practiceInformation[2];?>">
                    <br>
                    <input type="text" class="form-control" name="ZIP" placeholder="Postleitzahl" value="<?php echo $practiceInformation[3];?>">
                    <br>
                    <input type="text" class="form-control" name="city" placeholder="Ort" value="<?php echo $practiceInformation[4];?>">
                  </div>
                </div>
                <div class="col-6">
                  <u>
                    <h5>Kontaktinformationen</h5>
                  </u>
                  <br>
                  <div class="form-group">
                    <input type="text" class="form-control" name="telephone" placeholder="Telefonnummer" value="<?php echo $practiceInformation[5];?>">
                    <br>
                    <input type="text" class="form-control" name="homepage" placeholder="Internetadresse" value="<?php echo $practiceInformation[7];?>">
                    <br>
                    <input type="email" class="form-control" name="email" placeholder="E-Mail-Adresse" value="<?php echo $_SESSION['userid']?>">
                    <br>
                    <input type="text" class="form-control" name="socialmedia" placeholder="Facebook" value="<?php echo $practiceInformation[8];?>">
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group">
                    <textarea type="text" class="form-control" name="comment" rows="8" placeholder="Schreiben Sie etwas über Ihre Praxis"><?php echo $practiceInformation[9];?></textarea>
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group">
                    <button type="submit" name="save" class="btn btn-secondary btn-md">Speichern</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
          <div class="col-4">
            <div class="container">
              <span class="float-left">
              <div class="row">
                <u>
                  <h5>Profilbild</h5>
                </u>
                <button class="btn border rounded-circle ml-2" onclick="showFileUploader()"><i class="material-icons" style="font-size: 16px" >create</i>
              </div>
                <br>
                  <form class="border pl-2 pb-3" id="fileUpload" action="includes/upload.php" method = "post" enctype="multipart/form-data">
                    <button class="btn float-right" onclick="cancelUpload()"> <i class="material-icons float-right" style="font-size: 24px" >close</i></button>
                    <input type="hidden" id='imagePath' value=<?php echo"'".$practiceInformation[10]."'"?>>
                    <input type="file" name="fileToUpload">
                    <input type="hidden" name="email" value=<?php echo "'". $_SESSION['userid']."'"?>><br>
                    <br>
                    <button type="submit" class="btn btn-secondary btn-sm ml-3" name="submit">Upload</button>
                  </form>
                  <img id="picture" src=<?php echo "'".$practiceInformation[10]."'"?> style="width:100%; heigth:100%;">
              </span>
            </div>
            <div class="container">
              <div class="row pt-5">
                <u>
                  <h6>Kontooptionen</h6>
                </u>
              </div>
              <div class="row">
                <a href="changePassword.php" style="font-size: 10pt; color: blue"> Passwort ändern </a>
              </div>
              <div class="row">
                <a href="deleteAccount.php" style="font-size: 10pt; color: blue"> Konto löschen </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
</body>

<?php include ('includes\footer.php') ?>

<script>
function showPicture(){
  var x = document.forms["fileUpload"]["imagePath"].value;
  if(x == ""){
    document.getElementById("picture").style.display = "none";
  }else{
    document.getElementById("fileUpload").style.display = "none";
  }
}

function showFileUploader(){
  document.getElementById("picture").style.display = "none";
  document.getElementById("fileUpload").style.display = "block";
}

function cancelUpload(){
  document.getElementById("picture").style.display = "block";
  document.getElementById("fileUpload").style.display = "none";
}
</script>
