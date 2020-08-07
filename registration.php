<?php 
   $PasswordHash;
   session_start();
    include ('includes\model.php');
    include ('includes\headerLogedOut.php');
    if(isset($_POST["register"])){
      if (!empty($_POST["InputMedicalPractice"]) and !empty($_POST["InputEmail"]) and !empty($_POST["InputPassword"])){
        $PasswordHash = password_hash($_POST["InputPassword"],PASSWORD_DEFAULT);
        User::newUser($_POST["InputMedicalPractice"], $_POST["InputEmail"], $PasswordHash);  
        $_SESSION['userid'] = $_POST['InputEmail'];
        header('Location:practiceInformation.php');
      }
      else{
        echo "Die Felder dürfen nicht leer sein.";
        };
    }
?>
<body class="bg-light">
  <div class="container pt-4 pb-4">
    <div class="row pb-4">
      <div class="col-md-6">
        <u>
        <h3>Registrierung</h3>
        </u>
        <form class="pt-3 pb-3" action="" method="post">
          <input type="text" class="form-control" name="InputMedicalPractice" placeholder="Praxisname"><br>
          <input type="email" class="form-control" name="InputEmail"aria-describedby="emailHelp" placeholder="E-Mail-Adresse"> <br>
          <input type="password" class="form-control" name="InputPassword" placeholder="Passwort"> <br>
          <button type="submit" name="register" class="btn btn-secondary">Registrieren</button>
        </form>
      </div>
      <div class="col-md-6">
        <img src="images\waitingroom.jpg" alt="watingroom" style="width: 100%; height:100%">
      </div>
    </div>
  </div>
</body>
<?php include ('includes\footer.php'); ?>