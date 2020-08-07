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

if(isset($_POST["delete"])){
    $returnValue = User::deleteUser($_SESSION["userid"], $_POST["Input"]);
    if(empty($returnValue)){
      session_destroy();
      header('Location:index.php');
    }
}
?>
<body>
  <div class="container d-flex justify-content-center pt-3">
    <div class="col-4 text-center border rounded pt-3">
    <h2>Konto löschen</h2>
    <form id="deleteAccount" class="pt-3 pb-3" action="" method="post">
      <input type="password" class="form-control" name="Input" placeholder="Passwort"> <br>
      <button type="submit" name="delete" class="btn btn-secondary">Löschen</button>
    </form>
    <?php if(!empty($returnValue)){echo "<p id='errorLabel' style='color: red'>".$returnValue."</p>";}?>
    </div>
  </div>
</body>
<?php include ('includes\footer.php') ?>