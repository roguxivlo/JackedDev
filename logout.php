<html>
  <head>
    <title> JackedDev - Wylogowanie </title>
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
    </center>
  </div>
  <!-- Connect to mysql databse -->
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
  </body>