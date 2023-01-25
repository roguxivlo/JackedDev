<?php
  session_start();
  $exercise_id = $_GET['id'];
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

  $equipment_query = "SELECT equipment_name FROM equipment JOIN required_equipment ON equipment.id = required_equipment.equipment_id JOIN exercise ON exercise.id = required_equipment.exercise_id WHERE exercise.id = $exercise_id";
  // echo $equipment_query . "<br>";
  $equipment_statement = oci_parse($connection, $equipment_query);
  oci_execute($equipment_statement);
  $equipment_assoc = oci_fetch_array($equipment_statement, OCI_ASSOC);
  $equipment = $equipment_assoc['EQUIPMENT_NAME'];


  $description_query = "SELECT exercise_description
  FROM exercise_description
    JOIN exercise ON exercise.id = exercise_description.id
  WHERE exercise.id = $exercise_id";
  // echo $description_query . "<br>";

  $description_statement = oci_parse($connection, $description_query);
  oci_execute($description_statement);
  $description_assoc = oci_fetch_array($description_statement, OCI_ASSOC);
  $description = $description_assoc['EXERCISE_DESCRIPTION'];

  // echo $description . "<br>";

  $difficulty_query = "SELECT difficulty_level FROM exercise WHERE id = $exercise_id";
  // echo $difficulty_query . "<br>";
  $difficulty_statement = oci_parse($connection, $difficulty_query);
  oci_execute($difficulty_statement);
  $difficulty_assoc = oci_fetch_array($difficulty_statement, OCI_ASSOC);
  $difficulty = $difficulty_assoc['DIFFICULTY_LEVEL'];
  // echo $difficulty . "<br>";

  $muscles_query = "SELECT muscle_name FROM muscle JOIN used_muscle ON muscle.id = used_muscle.muscle_id JOIN exercise ON exercise.id = used_muscle.exercise_id WHERE exercise.id = $exercise_id";
  // echo $muscles_query . "<br>";
  $muscles_statement = oci_parse($connection, $muscles_query);
  oci_execute($muscles_statement);
  $muscles = array();
  while ($row = oci_fetch_array($muscles_statement, OCI_ASSOC)) {
    array_push($muscles, $row['MUSCLE_NAME']);
  }
  // echo $muscles[0] . "<br>";
?>
<html>
  <head>
    <title> JackedDev: <?php echo $name; ?> </title>
    <meta charset="utf-8">
</head>

<body>
<div>
    <center>
      <table>
        <tr>
          <td><a href="index.php">Strona Główna</a></td>
        </tr>
        <tr>
          <td><a href="search.php">Szukaj Ćwiczeń</a></td>
        </tr>
        <?php
        if (isset($_SESSION['login'])) {
          echo "<tr><td><a href='user_page.php'>Twoje treningi</a></td></tr>";
          echo "<tr><td><a href='logout.php'>Wyloguj się</a></td></tr>";
        }
        else {
          echo "<tr><td><a href='login.php'>Zaloguj się</a></td></tr>";
          echo "<tr><td><a href='register.php'>Zarejestruj się</a></td></tr>";
        }
        ?>
      </table>
    </center>
  </div>
  <div>
    <center>
      <h1> <?php echo $name; ?> </h1>
      <h2> Equipment: </h2>
      <p> <?php echo $equipment; ?> </p>
      <h2> Targeted muscles: </h2>
      <p> <?php
        for ($i = 0; $i < count($muscles); $i++) {
          echo $muscles[$i];
          if ($i != count($muscles) - 1) {
            echo ", ";
          }
        }
      ?> </p>
      <h2> Difficulty: </h2>
      <p> <?php echo $difficulty; ?> </p>
      <h2> Description: </h2>
      <p> <?php echo $description; ?> </p>
      
    </center>
  </div>
</html>