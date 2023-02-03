<!DOCTYPE html lang="pl">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="register.css">
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
            echo "<button class='login_and_register_button' id='logout_button'>";
            echo "Wyloguj";
            echo "</button>";
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
        <!-- rejestracja -->
        <center>
        <form action="#" method="post">
            <table>
            <tr>
                <td>Login:</td>
                <td><input type="text" name="login"></td>
            </tr>
            <tr>
                <td>Hasło:</td>
                <td><input type="password" name="password"></td>
            </tr>
            <tr>
                <td>Powtórz hasło:</td>
                <td><input type="password" name="password2"></td>
            </tr>
            <tr>
                <td><input type="submit" value="Zarejestruj"></td>
            </tr>
            </table>
        </form>
        </center>


        <!-- Connect to mysql databse -->
        <?php
        if (isset($_POST["login"])){
        $login = "jr440002";
        $password = "haslo";
        $host = "//labora.mimuw.edu.pl/LABS";

        $connection = oci_connect($login, $password, $host);

        if (!$connection) {
            echo "oci_connect failed\n";
            $e = oci_error();
            echo $e['message'];
        }
        else {
            $user_login = $_POST["login"];
            $user_password = $_POST["password"];
            $user_password2 = $_POST["password2"];
            // echo "$user_login, $user_password, $user_password2<br>";
            if ($user_password != $user_password2) {
            echo "Hasła nie są takie same";
            }
            else {
            $query = "INSERT INTO USERS (LOGIN, PASSWORD) VALUES ('$user_login', '$user_password')";
            $statement = oci_parse($connection, $query);
            $r = oci_execute($statement);
            if (!$r) {
                $e = oci_error($statement);
                echo $e['message'];
            }
            else {
                echo "Zarejestrowano użytkownika $user_login";
            }
            }
        }
        }
        ?>
    </div>

    <div class="menu">
        <div class="col2"> 
            <a href="search.php">
                <button class="bottom_button" id="bottom_button1"> Szukaj Ćwiczeń </button>
            </a>
        </div>
        <div class="col2"> 
            <a href="index.php">
                <button class="bottom_button" id="bottom_button2"> Strona Główna </button>
            </a>
        </div>
    </div>
</div>
</body>

</html>