<html>
  <head> 
    <title>JackedDev - Dodaj Ćwiczenie</title>
  <meta charset="utf-8">
</head>
<body>
  <center>
  <?php
    session_start();
    $training_id = $_GET['training_id'];
    // display current training
    // connect to database and display training
    $conn = oci_connect($_SESSION['sql_login'], $_SESSION['sql_password'], $_SESSION['sql_host']);
    if (!$conn) {
      echo "oci_connect failed";
      exit;
    }
    $query = "SELECT * FROM training WHERE id = $training_id";
    $stid = oci_parse($conn, $query);
    $r = oci_execute($stid);
    if (!$r) {
      $e = oci_error($stid);
      trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
    }
    else {
      $row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS);
      echo "Trening dnia: ".$row['TRAINING_DATE']."<br>";
    }
    // display exercises
    $query = "SELECT * FROM exercises_per_training JOIN exercise ON exercise_id = exercise.id WHERE training_id = $training_id";
    $stid = oci_parse($conn, $query);
    $r = oci_execute($stid);
    if (!$r) {
      $e = oci_error($stid);
      trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
    }
    else {
      echo "<table border='1'>\n";
      echo "<tr>\n";
      echo "<th>Ćwiczenie</th>\n";
      echo "<th>Liczba Serii</th>\n";
      echo "<th>Powtórzenia</th>\n";
      echo "</tr>\n";
      while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
        echo "<tr>\n";
        echo "<td>".$row['EXERCISE_NAME']."</td><td>".$row['SERIES']."</td><td>".$row['REPETITIONS']."</td>\n";
        echo "</tr>\n";
      }
      echo "</table>\n";
    }
    echo "<a href=search.php?training_id=" .$training_id.">Dodaj Nowe ćwiczenie: wyszukaj ćwiczenie i kliknij dodaj</a>";
  ?>

  </center>
</body>