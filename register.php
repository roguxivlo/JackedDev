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
            <td><a href="search.php">Szukaj Ćwiczeń</a></td>
          </tr>
          <?php
            session_start();
            if (isset($_SESSION['login'])) {
              echo "<tr><td><a href='user_page.php'>Twoje treningi</a></td></tr>";
              echo "<tr><td><a href='logout.php'>Wyloguj się</a></td></tr>";
              echo "<tr><td>Jesteś już zalogowany, ".$_SESSION['login']."</td></tr>";
              exit;
            }
            else {
              echo "<tr><td><a href='login.php'>Zaloguj się</a></td></tr>";
              echo "<tr><td><a href='register.php'>Zarejestruj się</a></td></tr>";
            }
          ?>
        </table>
        <form action="register.php" method="post">
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
    </div>
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
    </body>
</html>