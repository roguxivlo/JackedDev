<!DOCTYPE html lang="pl">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="main.css">
    <title>JackedDev.com</title>
</head>

<body>
<div class="main_page">
    <?php
        session_start();
        if (isset($_SESSION['login'])) {
            echo "<div class='login_and_register'>";
            echo "<div class='login_and_register_button_div'>";
            echo "<a href='logout.php'>";
            echo "<button class='login_and_register_button' id='logout_button'>";
            echo "Wyloguj"; 
            echo "</button>";
            echo "</a>";
            echo "</div>";
            echo "</div>";
        }
        else {
            echo "<div class='login_and_register'>";
            echo "<div class='login_and_register_button_div'>";
            echo "<a href='register.php'>";
            echo "<button class='login_and_register_button' id='register_button'>";
            echo "Zarejestruj"; 
            echo "</button>";
            echo "</a>";
            echo "</div>";

            echo "<div class='login_and_register_button_div'>";
            echo "<a href='login.php'>";
            echo "<button class='login_and_register_button' id='login_button'>";
            echo "Zaloguj";
            echo "</button>";
            echo "</a>";
            echo "</div>";
            echo "</div>";
        }
    ?>
    <div class="content">
        <h1 class="title"> JackedDev </h1>
        <p class="main_page_text"> 
        Witaj na stronie JackedDev.com. Strona powstała, by pomagać znaleźć ćwiczenia odpowiadające naszym potrzebą oraz możliwością sprzętowym. Aby wyszukać ćwiczenie przejdź do sekcji "Szukaj Ćwiczeń" a następnie powiedz nam na jakich partiach mięśniowych Ci zależy, na jakim poziomie zaawansowania jesteś oraz jakiego sprzętu planujesz użyć, a my znajdziemy Ci odpowiednie ćwiczenia! Następnie możesz przyjrzeć się każdemu z ćwiczeń dokładniej wybierając je z listy. Na stronie znajduje się opis każdego z ćwiczeń i instrukcje wykonania. Po zarejestrowaniu strona umożliwia także zapisywanie własnych treningów w celu śledzenia postępów. Zaloguj się i wejdź w zakładkę "Zapisz trening", podaj datę dnia, w którym trening został wykonany oraz kliknij "Dodaj Ćwiczenie" aby zacząć edytować trening. Wyszukaj odpowiednie ćwiczenie, wybierz ilość wykonanych powtórzeń i serii po czym dodaj ćwiczenie do treningu i wróć do edycji. Dodawaj kolejne ćwiczenia aż nie zapiszesz całego treningu, a następnie kliknij "Gotowe!". Dzięki temu możesz później wyświetlić uprzednio zapisane treningii i śledzić postępy. 
        </p>
    </div>

    <div class="menu">
        <?php
        if (isset($_SESSION['login'])) {
            // szukaj treningów
            echo "<div class='col3'>"; 
            echo "<a href='search.php'>";
            echo "<button class='bottom_button' id='bottom_button1'> Szukaj Ćwiczeń </button>";
            echo "</a>";
            echo "</div>";

            // dodanie treningów
            echo "<div class='col3'>"; 
            echo "<a href='add_training.php'>";
            echo "<button class='bottom_button' id='bottom_button2'> Zapisz Trening </button>";
            echo "</a>";
            echo "</div>";

            // historia treningów
            echo "<div class='col3'>"; 
            echo "<a href='training_history.php'>";
            echo "<button class='bottom_button' id='bottom_button3'> Historia Treningów </button>";
            echo "</a>";
            echo "</div>";
        }
        else {
            // szukaj treningów
            echo "<div class='col1'>"; 
            echo "<a href='search.php'>";
            echo "<button class='bottom_button' id='bottom_button1'> Szukaj Ćwiczeń </button>";
            echo "</a>";
            echo "</div>";
        }
        ?>
    </div>
</div>
</body>

</html>