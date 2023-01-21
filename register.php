<html>
  <head>
    <title> JackedDev - rejestracja </title>
    <meta charset="utf-8">
  </head>
  <body>
  <div>
      <center>
        <table>
          <tr>
            <td><a href="index.html">Strona Główna</a></td>
          </tr>
          <tr>
            <td><a href="search.html">Szukaj Ćwiczeń</a></td>
          </tr>
          <tr>
            <td><a href="login.html">Zaloguj się</a></td>
          </tr>
          <tr>
            <td><a href="register.html">Zarejestruj się</a></td>
          </tr>
        </table>
    </div>
    Rejestracja<br>
    <!-- Connect to mysql databse -->
    <?php

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
      echo "$user_login, $user_password, $user_password2<br>";
    }
    ?>
    </body>
</html>