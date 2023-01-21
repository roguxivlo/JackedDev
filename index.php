<html lang="pl">

<head>
  <meta charset="utf-8">
  <title>JackedDev.com</title>
</head>

<body>
  <!-- Table menu -->
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
        <?php
        session_start();
        if (isset($_SESSION['login'])) {
          echo "<tr><td><a href='logout.php'>Wyloguj się</a></td></tr>";
        }
        ?>
      </table>
    </center>

  </div>
</body>

</html>