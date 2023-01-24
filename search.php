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
              <option value="beginner">Beginner</option>
              <option value="intermediate">Intermediate</option>
              <option value="advanced">Advanced</option>
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
              <option value="ResistanceBands/Cables">Resistance Bands/Cables</option>
              <option value="HeavyRopes">Heavy Ropes</option>
              <option value="Cones">Cones</option>
              <option value="Kettlebells">Kettlebells</option>
              <option value="MedicineBall">Medicine Ball</option>
              <option value="NoEquipment">No Equipment</option>
              <option value="Ladder">Ladder</option>
              <option value="Bench">Bench</option>
              <option value="Dumbbells">Dumbbells</option>
              <option value="WeightMachines">Weight Machines / Selectorized</option>
              <option value="Barbell">Barbell</option>
              <option value="BOSUTrainer">BOSU Trainer</option>
              <option value="StabilityBall">Stability Ball</option>
              <option value="RaisedPlatformBox">Raised Platform/Box</option>
              <option value="PullUpBar">Pull up bar</option>
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

    $table_name = "exercies JOIN target_muscles ON exercises.id = target_muscles.exercise_id JOIN required_equipment ON exercises.id = required_equipment.exercise_id";

    if ($difficulty != "all") {
      $sql = "SELECT * FROM ".$table_name." WHERE difficulty_level = '$difficulty'";
    } else {
      $sql = "SELECT * FROM ".$table_name;
    }


    $sql = $sql.";";
    echo "<br>".$sql."<br><br>";

    $stmt = oci_parse($conn, $sql);
    oci_execute($stmt);
    while($row = oci_fetch_array($stmt, OCI_BOTH)) {
      echo $row['EXERCISE_NAME'] . $row['DIFFICULTY_LEVEL'] . "<br>";
    }

  } else {
    echo "Nie wybrałeś żadnych opcji<br>";
  }
  ?>
</body>

</html>