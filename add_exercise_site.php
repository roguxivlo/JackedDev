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
  $name_statement = oci_parse($connection, $name_query);
  oci_execute($name_statement);
  $name_assoc = oci_fetch_array($name_statement, OCI_ASSOC);
  $name = $name_assoc['EXERCISE_NAME'];

?>

<!DOCTYPE html lang="pl">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="add_exercise_site.css">
    <link rel="stylesheet" href="main.css">
    <title>JackedDev.com</title>
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

                <?php
                if (isset($_POST['submit'])) {
                    $training_id = $_POST['training_id'];
                    $exercise_id = $_POST['exercise_id'];
                    $name = $_POST['name'];
                    $repetitions = $_POST['repetitions'];
                    $series = $_POST['series'];
                    $query = "INSERT INTO exercises_per_training VALUES ($training_id, $exercise_id, $series, $repetitions)";
                    $statement = oci_parse($connection, $query);
                    $r = oci_execute($statement);
                    if (!$r) {
                    $e = oci_error($statement);
                    }
                    else {
                    echo "Dodano ćwiczenie $name do treningu $training_id";

                    // przycisk
                    echo "<div id='add_exercise_button_div'>";
                    echo "<a href=add_exercise.php?training_id=".$training_id.">";
                    echo "<button id='add_exercise_button'>";
                    echo "Powrót do edycji";
                    echo "</button>";
                    echo "</a>";
                    echo "</div>";
                    }
                }
                ?>
            
            </center>
        </div>
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