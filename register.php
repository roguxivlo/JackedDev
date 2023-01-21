<html>
  <head>
    <title> JackedDev - Rejestracja </title>
    <meta charset="utf-8">
  </head>
  <body>
  <div>
      <center>
        <table>
          <tr>
            <td><a href="index.php">Strona Główna</a></td>
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
    ?>
    </body>
</html>