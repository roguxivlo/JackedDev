<!DOCTYPE html lang="pl">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="main.css">
    <title>JackedDev.com</title>
</head>

<body>
<div class="main_page">
    <?php
        session_start();
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
    ?>

    <div class="content">
        <h1 class="title"> JackedDev </h1>

        <center>
        <?php
        session_start();
        if (isset($_SESSION['login'])) {
            session_destroy();
            echo "Wylogowano";
        }
        else {
            echo "Nie jesteś zalogowany";
        }
        ?>
        </center>
    </div>

    <div class="menu">
        <?php
            // szukaj treningów
            echo "<div class='col1'>"; 
            echo "<a href='search.php'>";
            echo "<button class='bottom_button' id='bottom_button1'> Szukaj Ćwiczeń </button>";
            echo "</a>";
            echo "</div>";
        ?>
    </div>
</div>
</body>

</html>