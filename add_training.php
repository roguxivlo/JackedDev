<html>
  <head>
    <title> JackedDev - Dodawanie treningów </title>
    <meta charset="utf-8">
    <script src="add_training.js"></script>
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
      </form>
    </center>  
  </body>
</html>