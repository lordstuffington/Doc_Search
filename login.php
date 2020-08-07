<html lang="de">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <link rel="stylesheet" href="main.css">

  <title>Doc Search</title>
</head>
<?php
  session_start();
  include ('includes\model.php');
  if(isset($_POST["register"])){
    if(!empty($_POST["InputEmail"]) and !empty($_POST["InputPassword"])){
      $valid = User::validateLogin($_POST["InputEmail"], $_POST["InputPassword"]);
      if($valid){
        $_SESSION['userid'] = $_POST['InputEmail'];
          header('Location:dashboard.php');
      }else{
        echo '<script> loginError();</script>';
      }
    }
  }
 ?>

<header>
<div class="container">
  <div class="row d-flex justify-content-center">
      <img src="images\logo.svg" alt="logo" class="mr-3" style="width: 50px; height: 50px;">
      <h1> Doc Search </h1>
  </div>
</div>
</header>

<body>
  <div class="container d-flex justify-content-center pt-3">
    <div class="col-4 text-center border rounded pt-3">
    <h2>Anmelden</h2>
    <form class="pt-3 pb-3" action="" method="post">
      <input type="email" class="form-control" name="InputEmail"aria-describedby="emailHelp" placeholder="E-Mail-Adresse"> <br>
      <input type="password" class="form-control" name="InputPassword" placeholder="Passwort"> <br>
      <button type="submit" name="register" class="btn btn-secondary">Anmelden</button>
    </form>
    <?php if($valid == false){echo "<p id='errorLabel' style='color: red'>Ungültiger Username oder Passwort</p>";}?>
    </div>
  </div>
  <div class="container d-flex justify-content-center pt-3">
    <div class="col-4 text-center">
      <hr />
      <p style="font-size: 10pt"> Oder registrieren </p>
      <a href="registration.php"><button type="submit" name="register" class="btn btn-secondary btn-sm">Zur Registierung</button></a>
    </div>
  </div>
</body>
<?php include ('includes\footer.php'); ?>
<script>
  function loginError(){
    getElementById("errorLabel").innerHtml = 'Benutzername oder Passwort falsch';
  }
</script>
