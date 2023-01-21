<html>
  <head>
    <title>JackedDev - Logowanie</title>
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
    <!-- Connect to mysql database -->
    <?php
    session_start();
    // Check if user is already logged in
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
    ?>
  </body>
</html>