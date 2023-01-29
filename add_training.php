<!DOCTYPE html>
  <head>
    <title> JackedDev - Dodawanie treningów </title>
    <meta charset="utf-8">
  </head>
  <body>
    <?php
    // check if logged in
    session_start();
    if (!isset($_SESSION["login"])) {
      header("location: login.php");
      exit;
    }
    ?>
    <center>
      <table>
        <tr>
          <td><a href="index.php"> Strona główna</a></td>     
        </tr>
      </table>
      <div>
        <h2>Podaj datę treningu</h2>
        <!-- date form -->
        <form action="add_training.php" method="post">
          <input type="date" name="date" value="<?php echo date('Y-m-d'); ?>">
          <input type="submit" name="submit" value="Wybierz datę">
      </div>
      
    </center>  
  </body>
  <?php
  if (isset($_POST["submit"])) {
    $conn = oci_connect($_SESSION['sql_login'], $_SESSION['sql_password'], $_SESSION['sql_host']);
    if (!$conn) {
      $e = oci_error();
      trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
    }
    $sql = "INSERT INTO training (user_login, training_date) VALUES ('". $_SESSION['login']."', TO_DATE('".$_POST["date"]."','YYYY-MM-DD'))";
    echo $sql."<br>";
    $stid = oci_parse($conn, $sql);
    $r = oci_execute($stid);
    if (!$r) {
      $e = oci_error($stid);
      trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
    }
    else {
      echo "Dodano trening dnia: <br>";
      echo $_POST["date"];
      // get training id
      $sql = "SELECT id FROM training WHERE ROWNUM = 1 ORDER BY id DESC";
      echo $sql."<br>";
      $stid = oci_parse($conn, $sql);
      $r = oci_execute($stid);
      if (!$r) {
        $e = oci_error($stid);
        trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
      }
      else {
        $row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS);
        $training_id = $row['ID'];
        $_SESSION['training_id'] = $training_id;
        echo "ID treningu: ".$training_id."<br>";
        // href to add_exercise.php
        echo "<a href='add_exercise.php?training_id=".$training_id."'>Dodaj ćwiczenie</a>";
      }
    }
  }
  ?>
</html>