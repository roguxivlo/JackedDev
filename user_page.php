<html>
  <?php
  session_start();
  if (!isset($_SESSION['login'])) {
    echo "Nie jesteś zalogowany!";
    exit;
  }
  ?>
  <head>
    <title> JackedDev: <?php echo $_SESSION['login']."-strona domowa";?> </title>
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
        <tr>
          <td><a href="add_training.php">Dodaj Trening</a></td>
        </tr>
        <tr>
          <td><a href="training_history.php">Historia Treningów</a></td>
        </tr>
        <tr><td><a href='logout.php'>Wyloguj się</a></td></tr>
      </table>
    </center>
  Witaj, <?php echo $_SESSION['login']; ?>! <br>
</div>
</body>