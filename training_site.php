<?php
session_start();
// check if logged in
if (!isset($_SESSION['login'])) {
  header("Location: login.php");
}

// get training id
$training_id = $_GET['training_id'];

// connect to db
$conn = oci_connect($_SESSION['sql_login'], $_SESSION['sql_password'], $_SESSION['sql_host']);
if (!$conn) {
  $e = oci_error();
  trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

?>
<html>
<head>
  <title> JackedDev: Trening <?php echo $training_id; ?> </title>
  <meta charset="utf-8">
</head>
<body>
  <?php
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
  ?>
</body>
</html>