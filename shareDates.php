<html lang="en">
<?php
include ('includes\headerLogedIn.php');
include ('includes\model.php');

session_start();
if(!isset($_SESSION['userid'])){
    die(Header("Location:index.php"));
}

//Logout
if(isset($_POST['btnlogout'])){
  session_destroy();
  header('Location:index.php');
}

$doctorArr = Doctor::getDoctors($_SESSION["userid"]);

if(isset($_POST["btn-share"])){
  $dates = json_decode($_POST["imagePath"]);
  ReleasedAppointment::addAppointments($dates, $_SESSION["userid"]);
}
?>

<body class="bg-light">
  <div class="container-fluid">
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
      <div class="col-11 pt-3">
        <u>
          <h3> Termine freigeben </h3>
        </u>
        <hr />
        <div class="container-fluid">
          <table class="table text-center table-bordered table-sm mt-5" id="dateTable">
            <thead>
              <tr>
                <th scope="col"><button class="btn" onclick="previousWeek();"><i class="material-icons" style="font-size: 24px"> keyboard_arrow_left</i></button></th>
                <th colspan="17">
                  <p id="week"></p>
                </th>
                <th scope="col"> <button class="btn" onclick="nextWeek();"><i class="material-icons" style="font-size: 24px"> keyboard_arrow_right</i></button> </th>
              </tr>
              <tr>
                <th scope="col">Termin</th>
                <th scope="col"> 08:00 </th>
                <th scope="col"> 08:30 </th>
                <th scope="col"> 09:00 </th>
                <th scope="col"> 09:30 </th>
                <th scope="col"> 10:00 </th>
                <th scope="col"> 10:30 </th>
                <th scope="col"> 11:00 </th>
                <th scope="col"> 11:30 </th>
                <th scope="col"> 12:00 </th>
                <th scope="col"> 12:30 </th>
                <th scope="col"> 13:00 </th>
                <th scope="col"> 13:30 </th>
                <th scope="col"> 14:00 </th>
                <th scope="col"> 14:30 </th>
                <th scope="col"> 15:00 </th>
                <th scope="col"> 15:30 </th>
                <th scope="col"> 16:00 </th>
                <th scope="col"> 16:30 </th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">Mo</th>
                <td class="td" id="Mo0800" onclick="clicked('Mo0800', 1, '08:00');"></td>
                <td class="td" id="Mo0830" onclick="clicked('Mo0830', 1, '08:30');"></td>
                <td class="td" id="Mo0900" onclick="clicked('Mo0900', 1, '09:00');"></td>
                <td class="td" id="Mo0930" onclick="clicked('Mo0930', 1, '09:30');"></td>
                <td class="td" id="Mo1000" onclick="clicked('Mo1000', 1, '10:00');"></td>
                <td class="td" id="Mo1030" onclick="clicked('Mo1030', 1, '10:30');"></td>
                <td class="td" id="Mo1100" onclick="clicked('Mo1100', 1, '11:00');"></td>
                <td class="td" id="Mo1130" onclick="clicked('Mo1130', 1, '11:30');"></td>
                <td class="td" id="Mo1200" onclick="clicked('Mo1200', 1, '12:00');"></td>
                <td class="td" id="Mo1230" onclick="clicked('Mo1230', 1, '12:30');"></td>
                <td class="td" id="Mo1300" onclick="clicked('Mo1300', 1, '13:00');"></td>
                <td class="td" id="Mo1330" onclick="clicked('Mo1330', 1, '13:30');"></td>
                <td class="td" id="Mo1400" onclick="clicked('Mo1400', 1, '14:00');"></td>
                <td class="td" id="Mo1430" onclick="clicked('Mo1430', 1, '14:30');"></td>
                <td class="td" id="Mo1500" onclick="clicked('Mo1500', 1, '15:00');"></td>
                <td class="td" id="Mo1530" onclick="clicked('Mo1530', 1, '15:30');"></td>
                <td class="td" id="Mo1600" onclick="clicked('Mo1600', 1, '16:00');"></td>
                <td class="td" id="Mo1630" onclick="clicked('Mo1630', 1, '16:30');"></td>
              </tr>
              <tr>
                <th scope="row">Di</th>
                <td class="td" id="Di0800" onclick="clicked('Di0800', 2, '08:00');"></td>
                <td class="td" id="Di0830" onclick="clicked('Di0830', 2, '08:30');"></td>
                <td class="td" id="Di0900" onclick="clicked('Di0900', 2, '09:00');"></td>
                <td class="td" id="Di0930" onclick="clicked('Di0930', 2, '09:30');"></td>
                <td class="td" id="Di1000" onclick="clicked('Di1000', 2, '10:00');"></td>
                <td class="td" id="Di1030" onclick="clicked('Di1030', 2, '10:30');"></td>
                <td class="td" id="Di1100" onclick="clicked('Di1100', 2, '11:00');"></td>
                <td class="td" id="Di1130" onclick="clicked('Di1130', 2, '11:30');"></td>
                <td class="td" id="Di1200" onclick="clicked('Di1200', 2, '12:00');"></td>
                <td class="td" id="Di1230" onclick="clicked('Di1230', 2, '12:30');"></td>
                <td class="td" id="Di1300" onclick="clicked('Di1300', 2, '13:00');"></td>
                <td class="td" id="Di1330" onclick="clicked('Di1330', 2, '13:30');"></td>
                <td class="td" id="Di1400" onclick="clicked('Di1400', 2, '14:00');"></td>
                <td class="td" id="Di1430" onclick="clicked('Di1430', 2, '14:30');"></td>
                <td class="td" id="Di1500" onclick="clicked('Di1500', 2, '15:00');"></td>
                <td class="td" id="Di1530" onclick="clicked('Di1530', 2, '15:30');"></td>
                <td class="td" id="Di1600" onclick="clicked('Di1600', 2, '16:00');"></td>
                <td class="td" id="Di1630" onclick="clicked('Di1630', 2, '16:30');"></td>
              </tr>
              <tr>
                <th scope="row">Mi</th>
                <td class="td" id="Mi0800" onclick="clicked('Mi0800', 3, '08:00');"></td>
                <td class="td" id="Mi0830" onclick="clicked('Mi0830', 3, '08:30');"></td>
                <td class="td" id="Mi0900" onclick="clicked('Mi0900', 3, '09:00');"></td>
                <td class="td" id="Mi0930" onclick="clicked('Mi0930', 3, '09:30');"></td>
                <td class="td" id="Mi1000" onclick="clicked('Mi1000', 3, '10:00');"></td>
                <td class="td" id="Mi1030" onclick="clicked('Mi1030', 3, '10:30');"></td>
                <td class="td" id="Mi1100" onclick="clicked('Mi1100', 3, '11:00');"></td>
                <td class="td" id="Mi1130" onclick="clicked('Mi1130', 3, '11:30');"></td>
                <td class="td" id="Mi1200" onclick="clicked('Mi1200', 3, '12:00');"></td>
                <td class="td" id="Mi1230" onclick="clicked('Mi1230', 3, '12:30');"></td>
                <td class="td" id="Mi1300" onclick="clicked('Mi1300', 3, '13:00');"></td>
                <td class="td" id="Mi1330" onclick="clicked('Mi1330', 3, '13:30');"></td>
                <td class="td" id="Mi1400" onclick="clicked('Mi1400', 3, '14:00');"></td>
                <td class="td" id="Mi1430" onclick="clicked('Mi1430', 3, '14:30');"></td>
                <td class="td" id="Mi1500" onclick="clicked('Mi1500', 3, '15:00');"></td>
                <td class="td" id="Mi1530" onclick="clicked('Mi1530', 3, '15:30');"></td>
                <td class="td" id="Mi1600" onclick="clicked('Mi1600', 3, '16:00');"></td>
                <td class="td" id="Mi1630" onclick="clicked('Mi1630', 3, '16:30');"></td>
              </tr>

              <tr>
                <th scope="row">Do</th>
                <td class="td" id="Do0800" onclick="clicked('Do0800', 4, '08:00');"></td>
                <td class="td" id="Do0830" onclick="clicked('Do0830', 4, '08:30');"></td>
                <td class="td" id="Do0900" onclick="clicked('Do0900', 4, '09:00');"></td>
                <td class="td" id="Do0930" onclick="clicked('Do0930', 4, '09:30');"></td>
                <td class="td" id="Do1000" onclick="clicked('Do1000', 4, '10:00');"></td>
                <td class="td" id="Do1030" onclick="clicked('Do1030', 4, '10:30');"></td>
                <td class="td" id="Do1100" onclick="clicked('Do1100', 4, '11:00');"></td>
                <td class="td" id="Do1130" onclick="clicked('Do1130', 4, '11:30');"></td>
                <td class="td" id="Do1200" onclick="clicked('Do1200', 4, '12:00');"></td>
                <td class="td" id="Do1230" onclick="clicked('Do1230', 4, '12:30');"></td>
                <td class="td" id="Do1300" onclick="clicked('Do1300', 4, '13:00');"></td>
                <td class="td" id="Do1330" onclick="clicked('Do1330', 4, '13:30');"></td>
                <td class="td" id="Do1400" onclick="clicked('Do1400', 4, '14:00');"></td>
                <td class="td" id="Do1430" onclick="clicked('Do1430', 4, '14:30');"></td>
                <td class="td" id="Do1500" onclick="clicked('Do1500', 4, '15:00');"></td>
                <td class="td" id="Do1530" onclick="clicked('Do1530', 4, '15:30');"></td>
                <td class="td" id="Do1600" onclick="clicked('Do1600', 4, '16:00');"></td>
                <td class="td" id="Do1630" onclick="clicked('Do1630', 4, '16:30');"></td>
              </tr>
              <tr>
                <th scope="row" id="friday">Fr</th>
                <td class="td" id="Fr0800" onclick="clicked('Fr0800', 5, '08:00');"></td>
                <td class="td" id="Fr0830" onclick="clicked('Fr0830', 5, '08:30');"></td>
                <td class="td" id="Fr0900" onclick="clicked('Fr0900', 5, '09:00');"></td>
                <td class="td" id="Fr0930" onclick="clicked('Fr0930', 5, '09:30');"></td>
                <td class="td" id="Fr1000" onclick="clicked('Fr1000', 5, '10:00');"></td>
                <td class="td" id="Fr1030" onclick="clicked('Fr1030', 5, '10:30');"></td>
                <td class="td" id="Fr1100" onclick="clicked('Fr1100', 5, '11:00');"></td>
                <td class="td" id="Fr1130" onclick="clicked('Fr1130', 5, '11:30');"></td>
                <td class="td" id="Fr1200" onclick="clicked('Fr1200', 5, '12:00');"></td>
                <td class="td" id="Fr1230" onclick="clicked('Fr1230', 5, '12:30');"></td>
                <td class="td" id="Fr1300" onclick="clicked('Fr1300', 5, '13:00');"></td>
                <td class="td" id="Fr1330" onclick="clicked('Fr1330', 5, '13:30');"></td>
                <td class="td" id="Fr1400" onclick="clicked('Fr1400', 5, '14:00');"></td>
                <td class="td" id="Fr1430" onclick="clicked('Fr1430', 5, '14:30');"></td>
                <td class="td" id="Fr1500" onclick="clicked('Fr1500', 5, '15:00');"></td>
                <td class="td" id="Fr1530" onclick="clicked('Fr1530', 5, '15:30');"></td>
                <td class="td" id="Fr1600" onclick="clicked('Fr1600', 5, '16:00');"></td>
                <td class="td" id="Fr1630" onclick="clicked('Fr1630', 5, '16:30');"></td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class=container-fluid>
          <div class="row">
            <div class="col-6">
              <form action="" method="Post">
                <div class="input-group-prepend pt-1">
                  <label class="input-group-text" for="inputDoctorSelect">Arzt</label>
                  <select class="doctorSelect" id="inputDoctorSelect" name="inputDoctorSelect">
                    <?php foreach ($doctorArr as $value) {
                      echo "<option>".$value."</option>";
                    }
                    ?>
                  </select>
                </div>
              </form>
            </div>
            <div class="col-6">
              <form action="" method="post">
                <span class="float-right pt-2">
                  <input type="hidden" name='imagePath' id='imagePath'></input>
                  <button type="submit" class="btn btn-secondary ml-3" name="btn-share" onclick="convertToJson()">Freigeben </button>
                </span>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
<?php include ('includes\footer.php') ?>

<script>
  var dateArr = new Array();
  var week = 0;

  //Calculate the date range of the current week
  var monday = findMonday(new Date());
  var sunday = findSunday(new Date());
  document.getElementById("week").innerHTML = ('0' + monday.getDate()).slice(-2) + "." + ('0' + (monday.getMonth() + 1)).slice(-2) + " - " + ('0' + sunday.getDate()).slice(-2) + "." + ('0' + sunday.getMonth()).slice(-2);

  // Calculate the date of Monday in the current week.
  function findMonday(date) {
    console.log(date.getDate() + '-' + (date.getDay() - 1));
    date.setDate(date.getDate() - (date.getDay() - 1));
    console.log("Calculated date: " + date);
    return date;
  }
  // Calculate the date of Sunday in the current week.
  function findSunday(date) {
    if (date.getDay() == 0) {
      date = new Date();
    } else {
      date.setDate(date.getDate() + (7 - date.getDay()));
    }
    return date;
  }
  //Get a day of the current week and calculate the date of the day.
  function findDateByDay(day) {
    var dayArr = [7, 1, 2, 3, 4, 5, 6];
    var today = new Date();
    var difference = day - dayArr[today.getDay()];
    var date = new Date(today.getFullYear(), today.getMonth(), today.getDate() + difference);
    date = date.getFullYear() + '-' + ('0' + (date.getMonth() + 1)).slice(-2) + '-' + ('0' + (date.getDate())).slice(-2);

    return date;
  }

  /*
  Receive id, day and start from the marked cell. When the cell is already
  marked send the id to deleteItem else send id, day, start ot markCell.
  */
  function clicked(id, day, start) {
    if (document.getElementById(id).style.backgroundColor == "grey") {
      deleteItem(id);
    } else {
      markCell(id, day, start);
    }
  }

  //Marks the clicked tabel cell and adds the chose date to the datelist.
  function markCell(id, day, start) {
    document.getElementById(id).style.backgroundColor = "grey";
    day = findDateByDay(day);
    dateArr.push([id, day, start]);
  }

  //Search for the id in the array and delete the entry
  function deleteItem(id) {
    var counter = 0;

    for (let i = 0; i < dateArr.length; i++) {
      let myArr = dateArr[i];
      for (let j = 0; j < myArr.length; j++) {
        if (myArr[0] == id) {
          dateArr.splice(i, 1);
          break;
        }
        j++;
      }
      i++;
    }
    document.getElementById(id).style.backgroundColor = "#f8f9fa";
  }

  function convertToJson() {
    var e = document.getElementById("inputDoctorSelect");
    var result = e.options[e.selectedIndex].value;

    dateArr.push(result);
    var datesJson = JSON.stringify(dateArr);

    document.getElementById("imagePath").value = datesJson;
  }

  function previousWeek() {
    week = week - 7;

    var date = new Date();
    date.setDate(date.getDate() + week);
    var PrevMonday = findMonday(date);

    var date = new Date();
    date.setDate(date.getDate() + week);
    var PrevSunday = findSunday(date);

    document.getElementById("week").innerHTML = ('0' + PrevMonday.getDate()).slice(-2) + "." + ('0' + (PrevMonday.getMonth() + 1)).slice(-2) + " - " + ('0' + PrevSunday.getDate()).slice(-2) + "." + ('0' + (PrevSunday.getMonth() + 1)).slice(-2);
  }

  function nextWeek() {
    week = week + 7;

    var date = new Date();
    date.setDate(date.getDate() + week);
    var PrevMonday = findMonday(date);

    var date = new Date();
    date.setDate(date.getDate() + week);
    var PrevSunday = findSunday(date);

    document.getElementById("week").innerHTML = ('0' + PrevMonday.getDate()).slice(-2) + "." + ('0' + (PrevMonday.getMonth() + 1)).slice(-2) + " - " + ('0' + PrevSunday.getDate()).slice(-2) + "." + ('0' + (PrevSunday.getMonth() + 1)).slice(-2);
  }
</script>
