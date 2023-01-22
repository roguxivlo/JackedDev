<html lang="pl">
  <head>
    <meta charset="utf-8">
    <title>JackedDev - Logowanie</title>
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
              echo "<tr><td> Jesteś zalogowany jako ".$_SESSION['login']."</td></tr>";
              exit;
            }
            else {
              echo "<tr><td><a href='login.php'>Zaloguj się</a></td></tr>";
              echo "<tr><td><a href='register.php'>Zarejestruj się</a></td></tr>";
            }
          ?>
        </table>
    </div>
    <div>
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
    </div>
    <?php
    // Check if user is already logged in
    if (isset($_POST["login"])) {
      if (isset($_SESSION['login'])) {
        echo "Jesteś już zalogowany, ".$_SESSION['login'];
        exit;
      }
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
            echo "Zalogowano użytkownika $user_login";
            $_SESSION['login'] = $user_login;
            $_SESSION['password'] = $user_password;
          }
          else {
            echo "Niepoprawny login lub hasło";
          }
        }
      }
    }
    
    ?>
</html>