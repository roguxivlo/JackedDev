<html>
  <head>
    <title> JackedDev: Twoje treningi <?php echo $name; ?> </title>
    <meta charset="utf-8">
  </head>
  <?php
  session_start();
  //  check if logged in
  if (!isset($_SESSION['login'])) {
    header("Location: login.php");
  }
  ?>
  <body>
    <center>
      <h1>Twoje treningi</h1>
      <table>
      <tr><td><a href="index.php">Strona główna</a></td></tr>
      <tr><td><a href="add_training.php">Dodaj trening</a></td></tr>
      <tr><td><a href="logout.php">Wyloguj</a></td></tr>
      </table>
    </center>
    <!-- Display user trainings -->
    <?php
    $conn = oci_connect($_SESSION['sql_login'], $_SESSION['sql_password'], $_SESSION['sql_host']);
    if (!$conn) {
      $e = oci_error();
      trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
    }
    $sql = "SELECT id, training_date FROM training WHERE user_login = '". $_SESSION['login'] ."'";
    echo $sql."<br>";
    $stid = oci_parse($conn, $sql);
    $r = oci_execute($stid);
    if (!$r) {
      $e = oci_error($stid);
      trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
    }
    else {
      echo "<center><table border='1'>\n";
      while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
        echo "<tr>\n";
        
        echo "<td><a href='training_site.php?training_id=".$row['ID']."'>".$row['TRAINING_DATE']."</td>\n";
        echo "</tr>\n";
      }
      echo "</table></center>\n";
    }

    ?>
  </body>
</html>