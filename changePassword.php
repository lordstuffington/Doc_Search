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

if(isset($_POST["btn-changePassword"])){
  $passwordHash = password_hash($_POST["newPassword"],PASSWORD_DEFAULT);
  User::changePassword($_SESSION['userid'], $_POST['oldPassword'], $passwordHash);
}
?>
<body>
  <div class="container d-flex justify-content-center pt-3">
    <div class="col-4 text-center border rounded pt-3">
    <h2>Passwort ändern</h2>
    <form class="pt-3 pb-3" action="" method="post">
      <input type="password" class="form-control" name="oldPassword" placeholder="Altes Passwort"> <br>
      <input type="password" class="form-control" name="newPassword" placeholder="Neues Passwort"> <br>
      <button type="submit" name="btn-changePassword" class="btn btn-secondary">Ändern</button>
    </form>
    <p id="errorLabel" style="color: red"></p>
    </div>
  </div>
</body>

<?php include ('includes\footer.php') ?>
