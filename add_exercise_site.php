<?php
  session_start();
  $exercise_id = $_GET['id'];
  $training_id = $_GET['training_id'];
  $login = "jr440002";
  $password = "haslo";
  $host = "//labora.mimuw.edu.pl/LABS";
  $connection = oci_connect($login, $password, $host);
  if (!$connection) {
    $m = oci_error();
    echo $m['message'], "\n";
    exit;
  }

  $name_query = "SELECT exercise_name FROM exercise WHERE id = $exercise_id";
  // echo $name_query . "<br>";
  $name_statement = oci_parse($connection, $name_query);
  oci_execute($name_statement);
  $name_assoc = oci_fetch_array($name_statement, OCI_ASSOC);
  $name = $name_assoc['EXERCISE_NAME'];
  // echo $name . "<br>";

?>
<html>
  <head>
    <title> JackedDev: Dodaj ćwiczenie <?php echo $name; ?> </title>
    <meta charset="utf-8">
</head>

<body>
<div>
    <center>
      <table>
        <tr>
          <td><a href=<?php echo "add_exercise.php?training_id=".$training_id.">";?>Powrót do edycji treningu</a></td>
        </tr>
      </table>
    </center>
  </div>
  <div>
    <center>
      <h1> <?php echo $name; ?> </h1>
      
      <form action="add_exercise_site.php" method="post">
        <input type="hidden" name="training_id" value=<?php echo $training_id; ?>>
        <input type="hidden" name="exercise_id" value=<?php echo $exercise_id; ?>>
        <input type="hidden" name="name" value=<?php echo $name; ?>>
        <table>
          <tr>
            <td> Liczba powtórzeń: </td>
            <td> <input type="number" name="repetitions" min="1" max="100" value="1"> </td>
          </tr>
          <tr>
            <td> Liczba serii: </td>
            <td> <input type="number" name="series" min="1" max="100" value="1"> </td>
          </tr>
        </table>
        <input type="submit" name="submit" value="Dodaj ćwiczenie">
      </form>

      
    </center>
  </div>
</body>
<?php
  // TODO: add exercise to training
  if (isset($_POST['submit'])) {
    $training_id = $_POST['training_id'];
    $exercise_id = $_POST['exercise_id'];
    $name = $_POST['name'];
    $repetitions = $_POST['repetitions'];
    $series = $_POST['series'];
    $query = "INSERT INTO training_exercise (training_id, exercise_id, repetitions, series) VALUES ($training_id, $exercise_id, $repetitions, $series)";
    // echo $query . "<br>";
    $statement = oci_parse($connection, $query);
    $r = oci_execute($statement);
    if (!$r) {
      $e = oci_error($statement);
      echo $e['message'];
    }
    else {
      echo "Dodano ćwiczenie $name do treningu $training_id";
    }
  }
?>
</html>