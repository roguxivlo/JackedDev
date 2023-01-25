<html>

<head>
  <script src="search.js"></script>
  <link rel="stylesheet" href="search.css">
  <meta charset="utf-8">
  <title>JackedDev - Wyszukiwarka</title>
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
        session_start();
        if (isset($_SESSION['login'])) {
          echo "<tr><td><a href='user_page.php'>Twoje treningi</a></td></tr>";
          echo "<tr><td><a href='logout.php'>Wyloguj się</a></td></tr>";
        } else {
          echo "<tr><td><a href='login.php'>Zaloguj się</a></td></tr>";
          echo "<tr><td><a href='register.php'>Zarejestruj się</a></td></tr>";
        }
        ?>
      </table>
    </center>
  </div>
  <div>
    <center>
      <form action="search.php" method="post">
        <table>
          <tr>

            <label for="difficulty">Difficulty: </label>
            <select id="difficulty" name="difficulty">
              <option value="all">All</option>
              <option value="Beginner">Beginner</option>
              <option value="Intermediate">Intermediate</option>
              <option value="Advanced">Advanced</option>
            </select>
          </tr>

          <tr>
            <div class="multiselect">
              <div class="selectBox" onclick="showCheckboxes()">
                <select>
                  <option>Select target muscles</option>
                </select>
                <div class="overSelect"></div>
              </div>
              <div id="checkboxes">
                <label for="Body/Integrated">
                  <input type="checkbox" name="Body/Integrated" />Calves</label>
                <label for="Calves">
                  <input type="checkbox" name="Calves" />Calves</label>
                <label for="Shins">
                  <input type="checkbox" name="Shins" />Shins</label>
                <label for="Thighs">
                  <input type="checkbox" name="Thighs" />Thighs</label>
                <label for="ABS">
                  <input type="checkbox" name="ABS" />ABS</label>
                <label for="Butt/Hips">
                  <input type="checkbox" name="Butt/Hips" />Butt/Hips</label>
                <label for="Shoulders">
                  <input type="checkbox" name="Shoulders" />Shoulders</label>
                <label for="Back">
                  <input type="checkbox" name="Back" />Back</label>
                <label for="Chest">
                  <input type="checkbox" name="Chest" />Chest</label>
                <label for="Arms">
                  <input type="checkbox" name="Arms" />Arms</label>
                <label for="Neck">
                  <input type="checkbox" name="Neck" />Neck</label>
              </div>
            </div>
          </tr>

          <tr>

            <label for="equipment">Equipment: </label>
            <select id="equipment" name="equipment">
              <option value="all">All</option>
              <option value="Resistance Bands/Cables">Resistance Bands/Cables</option>
              <option value="Heavy Ropes">Heavy Ropes</option>
              <option value="Cones">Cones</option>
              <option value="Kettlebells">Kettlebells</option>
              <option value="Medicine Ball">Medicine Ball</option>
              <option value="No Equipment">No Equipment</option>
              <option value="Ladder">Ladder</option>
              <option value="Bench">Bench</option>
              <option value="Dumbbells">Dumbbells</option>
              <option value="Weight Machines / Selectorized">Weight Machines / Selectorized</option>
              <option value="Barbell">Barbell</option>
              <option value="BOSU Trainer">BOSU Trainer</option>
              <option value="Stability Ball">Stability Ball</option>
              <option value="Raised Platform/Box">Raised Platform/Box</option>
              <option value="Pull up bar">Pull up bar</option>
              <option value="Hurdles">Hurdles</option>
              <option value="TRX">TRX</option>
            </select>
          </tr>
          <tr>
            <td><input type="submit" name="submit" value="Szukaj"></td>
          </tr>
        </table>
      </form>
    </center>
  </div>
  <?php
  if (isset($_POST["submit"])) {
    $difficulty = $_POST["difficulty"];
    $equipment = $_POST["equipment"];
    $targetMuscles = array();
    if (isset($_POST["Body/Integrated"])) {
      array_push($targetMuscles, "Body/Integrated");
    }
    if (isset($_POST["Calves"])) {
      array_push($targetMuscles, "Calves");
    }
    if (isset($_POST["Shins"])) {
      array_push($targetMuscles, "Shins");
    }
    if (isset($_POST["Thighs"])) {
      array_push($targetMuscles, "Thighs");
    }
    if (isset($_POST["ABS"])) {
      array_push($targetMuscles, "ABS");
    }
    if (isset($_POST["Butt/Hips"])) {
      array_push($targetMuscles, "Butt/Hips");
    }
    if (isset($_POST["Shoulders"])) {
      array_push($targetMuscles, "Shoulders");
    }
    if (isset($_POST["Back"])) {
      array_push($targetMuscles, "Back");
    }
    if (isset($_POST["Chest"])) {
      array_push($targetMuscles, "Chest");
    }
    if (isset($_POST["Arms"])) {
      array_push($targetMuscles, "Arms");
    }
    if (isset($_POST["Neck"])) {
      array_push($targetMuscles, "Neck");
    }

    echo "Wybrałeś:<br>";
    echo $difficulty . "<br>";
    echo $equipment . "<br>";
    for ($i = 0; $i < count($targetMuscles); $i++) {
      echo $targetMuscles[$i] . "<br>";
    }

    

    $query = "SELECT A.id, A.exercise_name
              FROM (
                SELECT E.id, exercise_name
                FROM exercise E JOIN required_equipment RE ON E.id = RE.exercise_id
                JOIN equipment ON equipment.id = RE.equipment_id";
    
    $cond1 = "0=0";
    $cond2 = "0=0";

    if ($equipment != "all") {
      $cond1 = " WHERE equipment_name = `$equipment`";
    }
    if ($difficulty != "all") {
      $cond2 = " difficulty_level = `$difficulty`";
    }

    $query = $query . " WHERE " . $cond1 . " AND " . $cond2;

    if (count($targetMuscles) > 0) {
      $query = $query . " WHERE (
        SELECT COUNT(*) FROM
          ((SELECT muscle_name FROM muscle WHERE muscle_name IN (";
      for ($i = 0; $i < count($targetMuscles); $i++) {
        $query = $query . "`$targetMuscles[$i]`";
        if ($i != count($targetMuscles) - 1) {
          $query = $query . ", ";
        }
      }
      $query = $query . "))";
      $query = $query . " MINUS (SELECT muscle_name
      FROM muscle JOIN used_muscle ON muscle.id = used_muscle.muscle_id
        JOIN exercise ON exercise.id = used_muscle.exercise_id
      WHERE exercise.id = A.id))
      ) = 0";
    }
    else {
      $query = $query . ") as A";
    }

    $login = "jr440002";
    $password = "haslo";
    $host = "//labora.mimuw.edu.pl/LABS";
    $connection = oci_connect($login, $password, $host);
    if (!$connection) {
      $e = oci_error();
      echo $e['message'];
      trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
      exit;
    }
    else {
      echo "Połączono z bazą danych<br>";
    }

    // $query = $query . ";";
    echo $query . "<br>";

    // get the results
    // $statement = oci_parse($connection, $query);
    $statement = oci_parse($connection, "SELECT * FROM exercise");

    // echo $statement . "<br>";

    if (!$statement) {
      echo "Nie udało się wykonać zapytania<br>";
      $e = oci_error($connection);
      echo $e['message'];
      trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
      exit;
    }

    oci_execute($statement, OCI_NO_AUTO_COMMIT);

    echo "<br>Znalezione ćwiczenia:<br>";

    // display the results
    echo "<table border='1'>\n";
    while (($row = oci_fetch_array($statement, OCI_ASSOC)) != false) {
      echo "<tr>\n";
      echo "<td>" . "chuj" . $row['A.ID'] . $row['A.EXERCISE_NAME'] . "</td>\n";
      echo "</tr>\n";
    }
    echo "</table>\n";
    echo "<br>";
    echo "Koniec wyników<br>";

  } else {
    echo "Nie wybrałeś żadnych opcji<br>";
  }
  ?>
</body>

</html>