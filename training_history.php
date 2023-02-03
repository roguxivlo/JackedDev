<!DOCTYPE html lang="pl">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="training_history.css">
    <link rel="stylesheet" href="main.css">
    <title>JackedDev.com</title>
</head>

<body>
<?php
session_start();
//  check if logged in
if (!isset($_SESSION['login'])) {
header("Location: login.php");
}
?>
<div class="main_page">
    <?php
        //session_start();
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
        $conn = oci_connect($_SESSION['sql_login'], $_SESSION['sql_password'], $_SESSION['sql_host']);
        if (!$conn) {
        $e = oci_error();
        trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }
        $sql = "SELECT id, training_date FROM training WHERE user_login = '". $_SESSION['login'] ."' ORDER BY training_date DESC";

        $stid = oci_parse($conn, $sql);
        $r = oci_execute($stid);
        if (!$r) {
        $e = oci_error($stid);
        trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }
        else {
        echo "<div id='search_result'>";
        echo "<nav>";
        echo "<ul>";
        while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
            
            echo "<li>";
            echo "<div class='list_div'>";
            echo "<a href='training_site.php?training_id=".$row['ID']."'>";
            echo "<button class='list_button'>";
            echo $row['TRAINING_DATE'];
            echo "</button>"; 
            echo "</a>";
            echo "</div>";
            echo "</li>";
        }
        echo "</ul>";
        echo "</nav>";
        }

        ?>
        </center>
    </div>

    <div class="menu">
        <?php
        if (isset($_SESSION['login'])) {
            // strona główna
            echo "<div class='col3'>"; 
            echo "<a href='index.php'>";
            echo "<button class='bottom_button' id='bottom_button1'> Strona Główna </button>";
            echo "</a>";
            echo "</div>";

            // szukaj treningów
            echo "<div class='col3'>"; 
            echo "<a href='search.php'>";
            echo "<button class='bottom_button' id='bottom_button2'> Szukaj Ćwiczeń </button>";
            echo "</a>";
            echo "</div>";

            // dodanie treningów
            echo "<div class='col3'>"; 
            echo "<a href='add_training.php'>";
            echo "<button class='bottom_button' id='bottom_button3'> Zapisz Trening </button>";
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