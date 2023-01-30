<!DOCTYPE html lang="pl">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="login.css">
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
        <!-- logowanie -->
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
              <td><input type="submit" value="Zaloguj"></td>
            </tr>
            
          </table>
        </form>
        </center>

        <?php
        // Check if user is already logged in
        if (isset($_POST["login"])) {
        if (isset($_SESSION['login'])) {
            echo "Jesteś już zalogowany, ".$_SESSION['login'];
            //exit;
        }
        $login = "jr440002";
        $password = "haslo";
        $host = "//labora.mimuw.edu.pl/LABS";
        $_SESSION['sql_login'] = $login;
        $_SESSION['sql_password'] = $password;
        $_SESSION['sql_host'] = $host;
        $connection = oci_connect($login, $password, $host);
        if (!$connection) {
            echo "oci_connect failed\n";
            $e = oci_error();
            echo $e['message'];
        }
        else {
            $user_login = $_POST["login"];
            $user_password = $_POST["password"];
            $query = "SELECT * FROM USERS WHERE LOGIN = '$user_login' AND PASSWORD = '$user_password'";
            $statement = oci_parse($connection, $query);
            $r = oci_execute($statement);
            if (!$r) {
            $e = oci_error($statement);
            echo $e['message'];
            }
            else {
            $row = oci_fetch_array($statement, OCI_ASSOC);
            if ($row) {
                $_SESSION['login'] = $user_login;
                $_SESSION['password'] = $user_password;
                // zmiana w location
                header('Location: https://students.mimuw.edu.pl/~mm439937/bd/index.php');

            }
            else {
                echo "Niepoprawny login lub hasło";
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