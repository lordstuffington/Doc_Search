<?php
//error_reporting(0);
include ('includes\headerLogedIn.php');
include ('includes\model.php');

//Redirect to index.php, if session isn't set
session_start();
if(!isset($_SESSION['userid'])){
    die(Header("Location:index.php"));
}

if(isset($_POST['btnlogout'])){
  session_destroy();
  header('Location:index.php');
}

if(isset($_POST["btn-AppointmentToday1"])){
  Appointment::deleteAppointment($_POST["appointmentToday1"]);
}
if(isset($_POST["btn-AppointmentToday2"])){
  Appointment::deleteAppointment($_POST["appointmentToday2"]);
}
if(isset($_POST["btn-AppointmentToday3"])){
  Appointment::deleteAppointment($_POST["appointmentToday3"]);
}

if(isset($_POST["btn-AppointmentTomorrow1"])){
  Appointment::deleteAppointment($_POST["appointmentTomorrow1"]);
}
if(isset($_POST["btn-AppointmentTomorrow2"])){
  Appointment::deleteAppointment($_POST["appointmentTomorrow2"]);
}
if(isset($_POST["btn-AppointmentTomorrow3"])){
  Appointment::deleteAppointment($_POST["appointmentTomorrow3"]);
}

$name = MyPractice::getPracticeName($_SESSION['userid']);

$AppointmentsTomorrowArr = Appointment::getAppointmentsForTomorrow($name);
$AppointmentsTodayArr = Appointment::getAppointmentsForToday($name);

//echo 10*100;

?>
<body class="bg-light">
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
            <div class="col-6 mt-2">
              <u>
                <h3> <?php echo $name ?></h3>
              </u>
            </div>
          <div class="col-6 pt-2">
            <span class="float-right">
              <p id="date" style="font-size: 12pt"></p>
            </span>
          </div>
        </div>
        <div class="container mt-2" style="border-top-style: solid; border-color: orange">
            <table class="table table-bordered table-sm bg-info">
              <thead>
                <tr>
                  <th colspan="2">Statistik</th>
                  <th colspan="3" class="text-center"> Letzten 30 Tage </th>
                </tr>
                </thead>
                <tbody>
                  <th scope="col">Buchungen </th>
                  <th scope="col">  </th>
                  <th scope="col">Geplante Termine</th>
                  <th scope="col">Erledigte Termine</th>
                  <tr>
                    <td><?php Appointment::appointmentDifference($name);?>  </td>
                    <td>Diesen Monat:</td>
                    <td><?php echo Appointment::plannedAppointmentsMonth($name);?></td>
                    <td><?php echo Appointment::doneAppointmentsCurrentMonth($name);?></td>
                  </tr>
                  <tr>
                    <td>  </td>
                    <td>Heute:</td>
                    <td><?php Appointment::plannedAppointmentsToday($name);?></td>
                    <td><?php Appointment::doneAppointmentsToday($name);?></td>
                  </tr>
                </tbody>
            </table>
          </div>
          <div class="container">
            <div class="container pt-3 pb-2">
            <div class="row pt-2" style="border-top-style: solid; border-color: blue">
              <img src="images\iconNextDates.svg" style="height: 30px; width: 30px">
              <h4 class="pl-3"> Kommende Termine </h4>
          </div>
          </div>
            <table class="table table-bordered table-striped table-sm">
            <thead>
              <th colspan="6">Heute</th>
              <tr class="text-center">
                <th> Dauer </th>
                <th> Arzt </th>
                <th> Notizen </th>
                <th> Patient </th>
                <th> Link </th>
                <th> </th>
              </tr>
            </thead>
            <tbody class="text-center">
              <form action = "" method="post">
                <input type="hidden" name="appointmentToday1" value= <?php if(!empty($AppointmentsTodayArr[0])){echo $AppointmentsTodayArr[0];}else{echo 0;} ?>>
                <td> <?php if(!empty($AppointmentsTodayArr[1])){echo $AppointmentsTodayArr[1] . " - " . $AppointmentsTodayArr[2];} echo ' '; ?></td>
                <td> <?php if(!empty($AppointmentsTodayArr[3])){echo $AppointmentsTodayArr[3];} echo '   '; ?></td>
                <td> <?php if(!empty($AppointmentsTodayArr[4])){echo $AppointmentsTodayArr[4];} echo '   '; ?></td>
                <td> <?php if(!empty($AppointmentsTodayArr[5])){echo $AppointmentsTodayArr[5];} echo '   '; ?></td>
                <td> <?php if(!empty($AppointmentsTodayArr[6])){echo $AppointmentsTodayArr[6];} echo '   '; ?></td>
                <td> <button class="btn" name="btn-AppointmentToday1"><i class="fa fa-trash"></i></td>
              </form>
              <tr>
                <form action = "" method="post">
                <input type="hidden" name="appointmentToday2" value= <?php if(!empty($AppointmentsTodayArr[7])){echo $AppointmentsTodayArr[7];}else{echo 0;} ?>>
                  <td> <?php if(!empty($AppointmentsTodayArr[8])){echo $AppointmentsTodayArr[8] . " - " . $AppointmentsTodayArr[9];} echo '   '; ?></td>
                  <td> <?php if(!empty($AppointmentsTodayArr[10])){echo $AppointmentsTodayArr[10];} echo '   '; ?> </td>
                  <td> <?php if(!empty($AppointmentsTodayArr[11])){echo $AppointmentsTodayArr[11];} echo '   '; ?> </td>
                  <td> <?php if(!empty($AppointmentsTodayArr[12])){echo $AppointmentsTodayArr[12];} echo '   '; ?> </td>
                  <td> <?php if(!empty($AppointmentsTodayArr[13])){echo $AppointmentsTodayArr[13];} echo '   '; ?> </td>
                  <td> <button class="btn" name="btn-AppointmentToday2"><i class="fa fa-trash"></i></td>
                </form>
              </tr>
              <tr>
                <form action = "" method="post">
                <input type="hidden" name="appointmentToday3" value= <?php if(!empty($AppointmentsTodayArr[14])){echo $AppointmentsTodayArr[14];}else{echo 0;} ?>>
                <td> <?php if(!empty($AppointmentsTodayArr[15])){echo $AppointmentsTodayArr[15] . " - " . $AppointmentsTodayArr[16];} echo '   '; ?></td>
                  <td> <?php if(!empty($AppointmentsTodayArr[17])){echo $AppointmentsTodayArr[17];} echo '   '; ?> </td>
                  <td> <?php if(!empty($AppointmentsTodayArr[18])){echo $AppointmentsTodayArr[18];} echo '   '; ?> </td>
                  <td> <?php if(!empty($AppointmentsTodayArr[19])){echo $AppointmentsTodayArr[19];} echo '   '; ?> </td>
                  <td> <?php if(!empty($AppointmentsTodayArr[20])){echo $AppointmentsTodayArr[20];} echo '   '; ?> </td>
                  <td> <button class="btn" name="btn-AppointmentToday3"><i class="fa fa-trash"></i></td>
                </form>
              </tr>
            </tbody>
            </table>
          </div>
          <div class="container">
            <table class="table table-bordered table-striped table-sm">
            <thead>
              <th colspan="6">Morgen</th>
              <tr class="text-center">
                <th> Dauer </th>
                <th> Arzt </th>
                <th> Notizen </th>
                <th> Patient </th>
                <th> Link </th>
                <th> </th>
              </tr>
            </thead>
            <tbody class="text-center">
              <form action = "" method="post">
                <input type="hidden" name="appointmentTomorrow1" value= <?php if(!empty($AppointmentsTomorrowArr[0])){echo $AppointmentsTomorrowArr[0];}else{echo 0;} ?>>
                <td> <?php if(!empty($AppointmentsTomorrowArr[1])){echo $AppointmentsTomorrowArr[1] . " - " . $AppointmentsTomorrowArr[2];} echo '   '; ?></td>
                <td> <?php if(!empty($AppointmentsTomorrowArr[3])){echo $AppointmentsTomorrowArr[3];} echo '   '; ?></td>
                <td> <?php if(!empty($AppointmentsTomorrowArr[4])){echo $AppointmentsTomorrowArr[4];} echo '   '; ?></td>
                <td> <?php if(!empty($AppointmentsTomorrowArr[5])){echo $AppointmentsTomorrowArr[5];} echo '   '; ?></td>
                <td> <?php if(!empty($AppointmentsTomorrowArr[6])){echo $AppointmentsTomorrowArr[6];} echo '   '; ?></td>
                <td> <button class="btn" name="btn-AppointmentTomorrow1"><i class="fa fa-trash"></i></td>
              </form>
              <tr>
              <form action = "" method="post">
                <input type="hidden" name="appointmentTomorrow2" value= <?php if(!empty($AppointmentsTomorrowArr[7])){echo $AppointmentsTomorrowArr[7];}else{echo 0;} ?>>
                <td> <?php if(!empty($AppointmentsTomorrowArr[8])){echo $AppointmentsTomorrowArr[8] . " - " . $AppointmentsTomorrowArr[9];} echo '   '; ?></td>
                <td> <?php if(!empty($AppointmentsTomorrowArr[10])){echo $AppointmentsTomorrowArr[10];} echo '   '; ?> </td>
                <td> <?php if(!empty($AppointmentsTomorrowArr[11])){echo $AppointmentsTomorrowArr[11];} echo '   '; ?> </td>
                <td> <?php if(!empty($AppointmentsTomorrowArr[12])){echo $AppointmentsTomorrowArr[12];} echo '   '; ?> </td>
                <td> <?php if(!empty($AppointmentsTomorrowArr[13])){echo $AppointmentsTomorrowArr[13];} echo '   '; ?> </td>
                <td> <button class="btn" name="btn-AppointmentTomorrow2"><i class="fa fa-trash"></i></td>
              </form>
              </tr>
              <tr>
              <form action = "" method="post">
                <input type="hidden" name="appointmentTomorrow3" value= <?php if(!empty($AppointmentsTomorrowArr[14])){echo $AppointmentsTomorrowArr[14];}else{echo 0;} ?>>
                <td> <?php if(!empty($AppointmentsTomorrowArr[15])){echo $AppointmentsTomorrowArr[15] . " - " . $AppointmentsTomorrowArr[16];} echo '   '; ?></td>
                <td> <?php if(!empty($AppointmentsTomorrowArr[17])){echo $AppointmentsTomorrowArr[17];} echo '   '; ?> </td>
                <td> <?php if(!empty($AppointmentsTomorrowArr[18])){echo $AppointmentsTomorrowArr[18];} echo '   '; ?> </td>
                <td> <?php if(!empty($AppointmentsTomorrowArr[19])){echo $AppointmentsTomorrowArr[19];} echo '   '; ?> </td>
                <td> <?php if(!empty($AppointmentsTomorrowArr[20])){echo $AppointmentsTomorrowArr[20];} echo '   '; ?> </td>
                <td> <button class="btn" name="btn-AppointmentTomorrow3"><i class="fa fa-trash"></i></td>
              </form>
              </tr>
            </tbody>
            </table>
          </div>
        </div>
    </div>
  </div>
</div>
</body>
<?php include ('includes\footer.php') ?>

<script>
  var date = new Date();
  date.toLocaleString('de-DE');
  var weekdays = new Array("Sonntag", "Montag", "Dienstag", "Mittwoch", "Donnerstag", "Freitag", "Samstag");
  var today = weekdays[date.getDay()] + ", " + ('0' + date.getDate()).slice(-2) + "." + ('0' + (date.getMonth() + 1)).slice(-2)  + "." + date.getFullYear();
  document.getElementById("date").innerHTML = today;
</script>