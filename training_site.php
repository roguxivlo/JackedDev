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

<!DOCTYPE html lang="pl">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="training_site.css">
    <link rel="stylesheet" href="main.css">
    <title> JackedDev: Trening <?php echo $training_id; ?> </title>
</head>

<body>
<div class="main_page">
    <?php
        session_start();
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
        <center>
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
        </center>
    </div>

    <div class="menu">
        <?php
        if (isset($_SESSION['login'])) {
            // szukaj treningów
            echo "<div class='col3'>"; 
            echo "<a href='search.php'>";
            echo "<button class='bottom_button' id='bottom_button1'> Szukaj Ćwiczeń </button>";
            echo "</a>";
            echo "</div>";

            // dodanie treningów
            echo "<div class='col3'>"; 
            echo "<a href='add_training.php'>";
            echo "<button class='bottom_button' id='bottom_button2'> Zapisz Trening </button>";
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