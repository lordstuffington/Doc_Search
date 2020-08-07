<?php
class MyPractice{

  public static function newPractice($specialisation, $address, $postcode, $city, $telephone, $email, $website, $facebook, $note){
    $dbLink = new mysqli('localhost', 'root', '', 'docsearch');
    $sqlQuery = "Update practice set specialisation ='" . $specialisation . "', address = '" . $address . "', postcode = '" . $postcode . "', city = '". $city . "', telephone = '" . $telephone . "', email = '" . $email . "', website = '" . $website . "', facebook = '" . $facebook . "', note = '" .$note . "' where email = '" . $email . "'";
      //Check connection
      if(!$dbLink){
        die('Connection failed: ' . mysqli_connect_error());
      }

      //Insert into database
      if(mysqli_query($dbLink,$sqlQuery)){
      }else{
        echo 'Error: ' . $sqlQuery . '</br>' . mysqli_error($dbLink);
      }
  }

  public static function setPracticePicture($picturePath, $email){
    $dbLink = new mysqli('localhost', 'root', '', 'docsearch');
    // echo $email;
    $sqlQuery = "Update practice set picture ='". $picturePath ."' where email = '". $email ."'";

    if(mysqli_query($dbLink,$sqlQuery)){
    }else{
      echo 'Error: ' . $sqlQuery . '</br>' . mysqli_error($dbLink);
    }
  }

  public static function findPracticeByName($name){

  }

  public static function getPracticeName($email){
    $dbLink = new mysqli('localhost', 'root', '', 'docsearch');
    $sqlQuery = "select name from practice where email = '" . $email . "'";

    if(mysqli_connect_errno()){
      printf("Verbindung fehlgeschlagen: %s\n", mysqli_connect_error());
      exit();
    }

    if ($result = $dbLink->query($sqlQuery)){
      while($row = $result->fetch_row()){
        $name = $row[0];
      }
      $result->close();
      return $name;
    }
  }

  public static function getPracticeInformation(){
    $dbLink = new mysqli('localhost', 'root', '', 'docsearch');
    $sqlQuery = 'select name, specialisation, picture from practice';
    $array;
    $i = 0;

    if(mysqli_connect_errno()){
      printf("Verbindung fehlgeschlagen: %s\n", mysqli_connect_error());
      exit();
    }

    if ($result = $dbLink->query($sqlQuery)){
      while($row = $result->fetch_row()){
        foreach($row as $value){
          $array[$i] = $value;
          $i++;
        }

      }
      $result->close();

      }
      return $array;
    }

  public static function getPracticeInformationByEmail($email){
    $dbLink = new mysqli('localhost', 'root', '', 'docsearch');
    $sqlQuery = "select name, specialisation, address, postcode, city, telephone, email, website, facebook, note, picture from practice where email = '" . $email ."'";
    $array;
    $i = 0;

    if(mysqli_connect_errno()){
      printf("Verbindung fehlgeschlagen: %s\n", mysqli_connect_error());
      exit();
    }

    if ($result = $dbLink->query($sqlQuery)){
      while($row = $result->fetch_row()){
        foreach($row as $value){
          $array[$i] = $value;
          $i++;
        }
      }
      $result->close();
    }
    return $array;
  }

  public static function deletePractice($email){

  }
}

  class User{

    public static function newUser($name,$email, $password){
      $dbLink = new mysqli('localhost', 'root', '', 'docsearch');
      $sqlQueryUser = "insert into user (name, email, password) Values ('" . $name . "','" . $email ."','" . $password . "')";
      $sqlQueryPractice = "insert into practice (name, email) Values ('". $name ."','". $email ."')";
      //Check connection
      if(!$dbLink){
        die('Connection failed: ' . mysqli_connect_error());
      }

      //Insert Entry into Database user
      if(mysqli_query($dbLink,$sqlQueryUser)){
      }else{
        echo 'Error: ' . $sqlQueryUser . '</br>' . mysqli_error($dbLink);
      }

      //Insert entry into database practice
      if(mysqli_query($dbLink,$sqlQueryPractice)){
      }else{
        echo  'Error: ' . $sqlQueryPractice . '</br>' . mysqli_error($dbLink);
      }

    }

    public static function validateLogin($email, $password){
      $valid = false;
      $array;
      $i = 0;
      $dbLink = new mysqli('localhost', 'root', '', 'docsearch');
      $sqlQuery = "select email, password from user where email = '" . $email . "'";
      if(mysqli_connect_errno()){
        printf("Verbindung fehlgeschlagen: %s\n", mysqli_connect_error());
        exit();
      }

      if ($result = $dbLink->query($sqlQuery)){
        while($row = $result->fetch_row()){
          foreach($row as $value){
            $array[$i] = $value;
            $i++;
          }
        }
        $result->close();
      }
      if(!empty($array[0]) and password_verify($password, $array[1])){
        $valid = true;
        }
        return $valid;
    }

    public static function deleteUser($email, $password){
      $dbLink = new mysqli('localhost', 'root', '', 'docsearch');
      $sqlQueryDeleteUser = "delete from user where email = '".$email."'";
      $sqlQueryDeletePracticeInformation = "delete from practice where email = '".$email."'";
      $returnValue = "";

      if(self::validateLogin($email, $password)){
        if(Appointment::countAppointments($email) == 0){
          if(mysqli_connect_errno()){
            printf("Verbindung fehlgeschlagen: %s\n", mysqli_connect_error());
            exit();
          }
          if (($dbLink->query($sqlQueryDeleteUser)) AND ($dbLink->query($sqlQueryDeletePracticeInformation))){
          }else{
            echo 'SQL nicht ausgeführt';
          }
        }else{
          $returnValue = 'Löschen nicht möglich, da noch Termine offen sind.';
        }
      }else{
        $returnValue = 'Passwort ungültig';
      }
      return $returnValue;
    }

    public static function changePassword($username, $oldPassword, $newPassword){
      $dbLink = new mysqli('localhost', 'root', '', 'docsearch');
      $sqlQueryOldPassword = "select password from user where email = '".$username."'";
      $sqlQuerySetPassword = "update user set password = '".$newPassword."' where email = '".$username."'";

      if(mysqli_connect_errno()){
        printf("Verbindung fehlgeschlagen: %s\n", mysqli_connect_error());
        exit();
      }

      if ($result = $dbLink->query($sqlQueryOldPassword)){
        while($row = $result->fetch_row()){
          $password = $row[0];
        }
      }

      if(password_verify($oldPassword, $password)){
        if(mysqli_query($dbLink,$sqlQuerySetPassword)){
          echo 'Das Passwort wurde geändert.';
        }else{
          echo  'Error: ' . $sqlQueryPractice . '</br>' . mysqli_error($dbLink);
        }
      }
    }

}

class Appointment{

  public static function plannedAppointmentsMonth($name){
    $date = date('yy-m-d');

    $dbLink = new mysqli('localhost', 'root', '', 'docsearch');
    $sqlQuery = "select count(date) from appointment where (practice = '". $name . "') AND (date <='". date('yy-m-'.date('t',strtotime(date('yy-m-d')))) . "') AND (date > '". $date."') XOR (date = '".$date."') AND (start >= '". date('H:i:s') ."')";
    if(mysqli_connect_errno()){
      printf("Verbindung fehlgeschlagen: %s\n", mysqli_connect_error());
      exit();
    }

    if ($result = $dbLink->query($sqlQuery)){
      while($row = $result->fetch_row()){
      echo $row[0];
      }
    }

  }

  public static function doneAppointmentsCurrentMonth($name){
    $date = date('yy-m-d');

    $dbLink = new mysqli('localhost', 'root', '', 'docsearch');
    $sqlQuery = "select count(date) from appointment where (practice = '". $name . "') AND (date >='". date('yy-m-01') . "') AND (date < '". $date."') XOR (date = '".$date."') AND (start <= '". date('H:i:s') ."')";

    if(mysqli_connect_errno()){
      printf("Verbindung fehlgeschlagen: %s\n", mysqli_connect_error());
      exit();
    }

    if ($result = $dbLink->query($sqlQuery)){
      while($row = $result->fetch_row()){
      echo $row[0];
      }
    }
  }

    public static function appointmentDifference($name){
    $date = date('yy-m-d');
    $appointmentsLastMonth;
    $appointmentsCurrentMonth;
    $differencePercentage;
    $dbLink = new mysqli('localhost', 'root', '', 'docsearch');
    $sqlQueryLastMonth = "select count(date) from appointment where (practice = '". $name . "') AND (date >='". date("yy-m-01",strtotime("-1 month")) . "') AND (date < '".date('yy-m-01')."') XOR (date = '".$date."') AND (start <= '". date('H:i:s') ."')";
    $sqlQueryCurrentMonth = "select count(date) from appointment where (practice = '". $name . "') AND (date >='". date('yy-m-01') . "') AND (date < '". $date."') XOR (date = '".$date."') AND (start <= '". date('H:i:s') ."')";

    if(mysqli_connect_errno()){
      printf("Verbindung fehlgeschlagen: %s\n", mysqli_connect_error());
      exit();
    }

    if ($result = $dbLink->query($sqlQueryLastMonth)){
      while($row = $result->fetch_row()){
      $appointmentsLastMonth = $row[0];
      }
    }

    if ($result = $dbLink->query($sqlQueryCurrentMonth)){
      while($row = $result->fetch_row()){
      $appointmentsCurrentMonth = $row[0];
      }
    }
    if($appointmentsLastMonth == 0){
      $differencePercentage = 'Keine Termine im letzten Monat.';
    }else{
      $differencePercentage = number_format((($appointmentsCurrentMonth * 100 / $appointmentsLastMonth)-100),1) . ' %';
    }
    echo $differencePercentage;
  }

  public static function plannedAppointmentsToday($name){
    $date = date('yy-m-d');

    $dbLink = new mysqli('localhost', 'root', '', 'docsearch');
    $sqlQuery = "select count(date) from appointment where (practice = '". $name . "') AND (date = '". $date."') AND (start >= '". date('H:i:s') ."')";

    if(mysqli_connect_errno()){
      printf("Verbindung fehlgeschlagen: %s\n", mysqli_connect_error());
      exit();
    }

    if ($result = $dbLink->query($sqlQuery)){
      while($row = $result->fetch_row()){
      echo $row[0];
      }
    }
  }

  public static function doneAppointmentsToday($name){
    $date = date('yy-m-d');

    $dbLink = new mysqli('localhost', 'root', '', 'docsearch');
    $sqlQuery = "select count(date) from appointment where (practice = '". $name . "') AND (date = '". $date."') AND (start < '". date('H:i:s') ."')";

    if(mysqli_connect_errno()){
      printf("Verbindung fehlgeschlagen: %s\n", mysqli_connect_error());
      exit();
    }

    if ($result = $dbLink->query($sqlQuery)){
      while($row = $result->fetch_row()){
      echo $row[0];
      }
    }
  }

  public static function getAppointmentsForToday($practiceName){
    $date = date('yy-m-d');

    $dbLink = new mysqli('localhost', 'root', '', 'docsearch');
    $sqlQuery = "select id, DATE_FORMAT(start,'%H:%i'), DATE_FORMAT(end,'%H:%i'), doctor, note, patient, link from appointment where (practice = '". $practiceName . "') AND (date = '". $date . "')";
    $array = [];
    $i = 0;

    if(mysqli_connect_errno()){
      printf("Verbindung fehlgeschlagen: %s\n", mysqli_connect_error());
      exit();
    }

    if ($result = $dbLink->query($sqlQuery)){
      while($row = $result->fetch_row()){
        foreach($row as $value){
          $array[$i] = $value;
          $i++;
        }

      }
      $result->close();

      }
      return $array;

  }


  public static function getAppointmentsForTomorrow($practiceName){
    $date = date('yy-m-d', strtotime("tomorrow"));

    $dbLink = new mysqli('localhost', 'root', '', 'docsearch');
    $sqlQuery = "select id, DATE_FORMAT(start,'%H:%i'), DATE_FORMAT(end,'%H:%i'), doctor, note, patient, link from appointment where (practice = '". $practiceName . "') AND (date = '". $date . "')";
    $arr = [];
    $i = 0;

    if(mysqli_connect_errno()){
      printf("Verbindung fehlgeschlagen: %s\n", mysqli_connect_error());
      exit();
    }

    if ($result = $dbLink->query($sqlQuery)){
      while($row = $result->fetch_row()){
        foreach($row as $value){
          $arr[$i] = $value;
          $i++;
        }

      }
      $result->close();

      }
      return $arr;
  }

  public static function deleteAppointment($id){
    $dbLink = new mysqli('localhost', 'root', '', 'docsearch');
    $sqlQuery = "delete from appointment where id = ".$id."";

    if(mysqli_connect_errno()){
      printf("Verbindung fehlgeschlagen: %s\n", mysqli_connect_error());
      exit();
    }
    if ($result = $dbLink->query($sqlQuery)){
    }
  }

  public static function countAppointments($email){
    $practiceName = MyPractice::getPracticeName($email);
    $date = date('yy-m-d');
    $dbLink = new mysqli('localhost', 'root', '', 'docsearch');
    $sqlQuery = "select count (practice) from appointment where (practice = '".$practiceName."') AND (date > '".$date."')";

    $arr = [];
    $i = 0;

    if(mysqli_connect_errno()){
      printf("Verbindung fehlgeschlagen: %s\n", mysqli_connect_error());
      exit();
    }

    if ($result = $dbLink->query($sqlQuery)){
      while($row = $result->fetch_row()){
        foreach($row as $value){
          $arr[$i] = $value;
          $i++;
          echo $arr[0];
        }

      }
      $result->close();

      }else{
        return 0;
      }
      echo $arr[0];
      return $arr[0];
  }
}

class Doctor{
  function getDoctors($email){
    $names = array();
    $dbLink = new mysqli('localhost', 'root', '', 'docsearch');

    //Get practice name
    $practiceName = MyPractice::getPracticeName($email);
    $sqlQuery = "select name from doctor where practice = '".$practiceName."'";

    if(mysqli_connect_errno()){
      printf("Verbindung fehlgeschlagen: %s\n", mysqli_connect_error());
      exit();
    }

    if ($result = $dbLink->query($sqlQuery)){
      while($row = $result->fetch_assoc()){
        foreach ($row as $value) {
          array_push($names, $value);
          // code...
        }
      }
    }
      $result->close();
      return $names;
    }
}

class ReleasedAppointment{

  public static function addAppointments($dates, $email){
    $dbLink = new mysqli('localhost', 'root', '', 'docsearch');
    $doctor = end($dates);
    $start;

    //Delete the last element
    array_splice($dates,-1);

    foreach ($dates as $arr) {
      $start = strtotime($arr[2]);
      $end = date("H:i", strtotime("+30 minutes", $start));
      $sqlQuery = "Insert INTO releasedAppointment (doctor, email, date, start, end) VALUES ('" . $doctor . "','" . $email . "', '" . $arr[1] . "','".$arr[2]."','" . $end . "')";
      // $sqlQuery = "INSERT INTO releasedAppointment (doctor, email, date, start end) VALUES ('". $doctor ."','" . $email . "'," . $arr[1] .",'. $arr[2] .','.$end.')";

      // echo $sqlQuery;

      if(!$dbLink){
        die('Connection failed: ' . mysqli_connect_error());
      }

      //Insert into database
      if(mysqli_query($dbLink,$sqlQuery)){
      }
    }
  }
}

 ?>
