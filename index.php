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
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed cursus viverra odio, ut venenatis nisl imperdiet viverra. Nunc placerat ipsum rutrum risus accumsan vulputate. Pellentesque purus urna, auctor at tortor lobortis, bibendum consectetur elit. Aenean eu sapien massa. Aenean at augue mi. In hac habitasse platea dictumst. Nam facilisis consectetur tincidunt.
            Cras hendrerit mi nec consectetur sodales. Nullam ullamcorper dolor ac lectus gravida accumsan. Aenean consequat eros sed purus vehicula, at porta nisi ornare. Fusce porttitor, enim in hendrerit pulvinar, est nisi elementum risus, et tempor dolor nulla sed metus. Etiam semper nibh tellus. Fusce nec mattis elit. Vestibulum sit amet odio vitae ligula accumsan consectetur. Donec mattis magna sit amet tortor dignissim interdum id eu sem. Quisque iaculis sagittis elementum. Phasellus id pretium turpis. Duis blandit mattis bibendum.
            Fusce malesuada eget ipsum vitae suscipit. Interdum et malesuada fames ac ante ipsum primis in faucibus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Sed quis ornare elit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Duis pretium ante et felis congue, ac fermentum diam semper. Vivamus convallis, lacus non faucibus fermentum, dolor massa facilisis massa, vitae pretium tortor diam id felis. Pellentesque varius ultrices arcu et imperdiet. Praesent scelerisque ipsum ut ante porttitor interdum. Praesent accumsan placerat metus at auctor. Nunc volutpat risus ac dolor ultrices, ut accumsan lacus blandit. Aenean at scelerisque tortor. Integer vitae vehicula purus. Praesent nec lacinia magna. Vivamus et luctus velit, sit amet iaculis lacus. 
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
            echo "<a href='search.php'>";
            echo "<button class='bottom_button' id='bottom_button2'> Zapisz Trening </button>";
            echo "</a>";
            echo "</div>";

            // historia treningów
            echo "<div class='col3'>"; 
            echo "<a href='search.php'>";
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