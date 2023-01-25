<!DOCTYPE html>
  <head>
    <title> JackedDev - Dodawanie treningów </title>
    <meta charset="utf-8">
    <script src="add_training.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link rel="stylesheet" href="add_training.css">
  </head>
  <body>
    <center>
      <table>
        <tr>
          <td><a href="index.php"> Strona główna</a></td>     
        </tr>
      </table>
      <div>
        <h2>Zapisz trening</h2>
        <input type="text" id="exercise_input" placeholder="ćwiczenie">
        <input type="number" id="series" min="1" placeholder="ilość serii">
        <input type="number" id="repetitions" min="1" placeholder="ilość powtórzeń">
        <span onclick="newElement()" class="add_exercise_btn">Dodaj ćwiczenie</span>
      </div>
      <ul id="exercises_list" action="add_training.php" method="post">   
      </ul>
      <form method="post">
        <input action="javascript:void(0);" type="submit" name="submit" value="Dodaj">
      </form>  
    </center>  
  </body>
  <?php
  if (isset($_POST["submit"])) {
    echo "Dodano trening: <br>";    
    $exercises_array = $_POST['send_exercises'];
    $exercises_array = explode(',', $exercises_array);

    echo count($exercises_array) . "<br>";
    //for ($i = 0; $i < count($exercises_array); $i++) {
    //  echo $exercises_array[$i] . "<br>";
    //}
  }
  else {
    //echo "jeszcze nie zapisałeś treningu<br>";
  }
  ?>
</html>