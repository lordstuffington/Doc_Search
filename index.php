<?php
include ('includes\headerLogedOut.php');
include ('includes\model.php');
$practiceInformation = MyPractice::getPracticeInformation();
?>
<body class="bg-light">
  <div class="container-fluid bg-primary pb-3 pt-3">
    <div class="container">
      <div class="row text-center">
        <div class="input-group">
          <div class="input-group-prepend">
            <input type="text" class="form-control " placeholder="Arzt suchen">
            <div class="dropdown">
              <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownSpecialication" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Fachrichtung
              </button>
            </div>
          </div>
          <div class="input-group-prepend ml-3 mr-3">
            <input type="text" class="form-control" placeholder="Ort oder PLZ">
            <div class="dropdown">
              <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownRegion" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Umkreis </button>
            </div>
          </div>
          <a href="searchResults.html"><button type="submit" class="btn btn-secondary">Suchen</button></a>
        </div>
      </div>
    </div>
  </div>
  <div class="container-fluid bg-white">
    <div class="container pt-3 pb-4">
      <u>
        <h4>Rund um die Uhr</h4>
      </u>
      <div class="row ml-2">
        <div class="col-1 pt-2">
          <img src="images\iconCalendar.svg" style="width:30px; heigth:30px;">
        </div>
        <div class="col-3">
          <p> Kostenlos und ohne Anmeldung einen Termin vereinbaren</p>
        </div>
        <div class="col-1 pt-2">
          <img src="images\iconEnvelope.svg" style="width:30px; heigth:30px;">
        </div>
        <div class="col-3">
          <p> E-Mail Erinnerung einen Tag vor dem Termin</p>
        </div>
        <div class="col-1 pt-2">
          <img src="images\iconEnvelope.svg" style="width:30px; heigth:30px;">
        </div>
        <div class="col-3">
          <p> Arzttermin ohne das Haus zu verlassen</p>
        </div>
      </div>
    </div>
  </div>
  <div class="container mt-4">
    <u>
      <h4> Was Ihnen Doc Search bieten kann </h4>
    </u>
    <p class="mt-4">
      Doc Search bietet Ihnen ein Auswahl an Ärzten, bei denen Sie schnell und unkompliziert einen Termin
      für eine Online Sprechstunde buchen können und das ganze ohne Registrierung.
      Sie bekommen den Termin mit einem Link zu Ihrer Onlinesprechstunde ganz einfach per E-Mail.
    </p>
  </div>
  <div class="container mt-5">
    <u>
      <h4> So funktioniert Ihr Termin </h4>
    </u>
    <p class="mt-3">
      Am vereinbarten Termin klicken Sie einfach den Link in Ihrer E-Mail-Bestätigung an und werden direkt
      zur Sprechstunden mit dem Arzt verbunden.
    </p>
  </div>
  <br><br>
  </div>
  <div class="container pb-3 pt-1">
    <hr />
    <h5> Ärzte in Ihrer Nähe </h5>
    <div class="row pt-3">
      <div class="col-4">
        <div class="row">
          <div class="col-5">
            <img src="<?php echo $practiceInformation['2']?>" class="img-fluid" alt="Doctor">
          </div>
          <div class="col-7">
            <p>
              <?php echo "{$practiceInformation['0']} <br \>{$practiceInformation['1']}"; ?>
            </p>
            <a href="###"> Jetzt einen Termin buchen </a>
          </div>
        </div>
      </div>
      <div class="col-4">
        <div class="row">
          <div class="col-5">
            <img src="<?php echo $practiceInformation['5']?>" class="img-fluid" alt="Doctor">
          </div>
          <div class="col-7">
            <p>
            <?php echo $practiceInformation['3']?> <br>
            <?php echo $practiceInformation['4']?> <br>
            </p>
            <a href="###"> Jetzt einen Termin buchen </a>
          </div>
        </div>
      </div>
      <div class="col-4">
        <div class="row">
          <div class="col-5">
            <img src="<?php echo $practiceInformation['8']?>" class="img-fluid" alt="Doctor">
          </div>
          <div class="col-7">
            <p>
            <?php echo $practiceInformation['6']?> <br>
            <?php echo $practiceInformation['7']?> <br>
            </p>
            <a href="###"> Jetzt einen Termin buchen </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
<?php include ('includes/footer.php'); ?>