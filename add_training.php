<!DOCTYPE html lang="pl">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="add_training.css">
    <link rel="stylesheet" href="main.css">
    <title>JackedDev.com</title>
</head>

<body>
<div class="main_page">
    <?php
    // check if logged in
    session_start();
    if (!isset($_SESSION["login"])) {
      header("location: login.php");
      exit;
    }
    ?>
    <?php
        if (isset($_SESSION['login'])) {
            echo "<div class='login_and_register'>";
            echo "<div class='login_and_register_button_div'>";
            echo "<a href='logout.php'>";
            echo "<button class='login_and_register_button' id='logout_button'>";
            echo "Wyloguj"; 
            echo "</button>";
            echo "</a>";
            echo "</div>";
            echo "</div>";
        }
        else {
            echo "<div class='login_and_register'>";
            echo "<div class='login_and_register_button_div'>";
            echo "<a href='register.php'>";
            echo "<button class='login_and_register_button' id='register_button'>";
            echo "Zarejestruj"; 
            echo "</button>";
            echo "</a>";
            echo "</div>";

            echo "<div class='login_and_register_button_div'>";
            echo "<a href='login.php'>";
            echo "<button class='login_and_register_button' id='login_button'>";
            echo "Zaloguj";
            echo "</button>";
            echo "</a>";
            echo "</div>";
            echo "</div>";
        }
    ?>
    <div class="content">
        <h1 class="title"> JackedDev </h1>
        <div>
          <h2>Podaj datę treningu</h2>
            <form action="add_training.php" method="post">
            <input type="date" name="date" value="<?php echo date('Y-m-d'); ?>">
            <input type="submit" name="submit" value="Wybierz datę">
            </form>
        </div>
      <?php
      if (isset($_POST["submit"])) {
        $conn = oci_connect($_SESSION['sql_login'], $_SESSION['sql_password'], $_SESSION['sql_host']);
        if (!$conn) {
          $e = oci_error();
          trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }
        $sql = "INSERT INTO training (user_login, training_date) VALUES ('". $_SESSION['login']."', TO_DATE('".$_POST["date"]."','YYYY-MM-DD'))";
        //echo $sql."<br>";
        $stid = oci_parse($conn, $sql);
        $r = oci_execute($stid);
        if (!$r) {
          $e = oci_error($stid);
          trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }
        else {
          echo "Trening z dnia: ";
          echo $_POST["date"]."<br>";
          // get training id
          $sql = "SELECT id FROM training WHERE ROWNUM = 1 ORDER BY id DESC";
          echo "został dodany do Twojej historii<br>";
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
            echo "<div id='add_exercise_button_div'>";
            echo "<a href='add_exercise.php?training_id=".$training_id."'>";
            echo "<button id='add_exercise_button'>";
            echo "Dodaj Ćwiczenie";
            echo "</button>";
            echo "</a>";
            echo "</div>";
          }
        }
      }
      ?>
    </div>

    <div class="menu">
        <?php
        if (isset($_SESSION['login'])) {
            // szukaj treningów
            echo "<div class='col3'>"; 
            echo "<a href='index.php'>";
            echo "<button class='bottom_button' id='bottom_button1'> Strona Główna </button>";
            echo "</a>";
            echo "</div>";

            // dodanie treningów
            echo "<div class='col3'>"; 
            echo "<a href='search.php'>";
            echo "<button class='bottom_button' id='bottom_button2'> Szukaj Ćwiczeń </button>";
            echo "</a>";
            echo "</div>";

            // historia treningów
            echo "<div class='col3'>"; 
            echo "<a href='training_history.php'>";
            echo "<button class='bottom_button' id='bottom_button3'> Historia Treningów </button>";
            echo "</a>";
            echo "</div>";
        }
        else {
            // szukaj treningów
            echo "<div class='col1'>"; 
            echo "<a href='search.php'>";
            echo "<button class='bottom_button' id='bottom_button1'> Szukaj Ćwiczeń </button>";
            echo "</a>";
            echo "</div>";
        }
        ?>
    </div>
</div>
</body>

</html>