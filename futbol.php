<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rozgrywki futbolowe</title>
    <link rel="stylesheet" href="styl.css">
</head>

<body>
    <?php
    $connect = new mysqli('localhost', 'root', '', 'egzamin');
    ?>
    <header id="baner">
        <h2>Światowe rozgrywki piłkarskie</h2>
        <img src="obraz1.jpg" alt="boisko">
    </header>
    <section id="mecze">
        <?php
        $sql = "SELECT zespol1, zespol2, wynik, data_rozgrywki FROM rozgrywka WHERE zespol1 = 'EVG'";
        $result = $connect->query($sql);
        while ($row = $result->fetch_assoc()) {
            echo "<div id=\"mecz\">";
            $zespol1 = $row['zespol1'];
            $zespol2 = $row['zespol2'];
            $wynik = $row['wynik'];
            $data = $row['data_rozgrywki'];
            echo "<h3>$zespol1 - $zespol2</h3>";
            echo "<h4>$wynik</h4>";
            echo "<p>w dniu: $data</p>";
            echo "</div>"; # /mecz
        }

        ?>
    </section>
    <main>
        <h2>Reprezentacja Polski</h2>
    </main>
    <div id="lewy">
        <p>Podaj pozycje zawodników (1-bramkarze, 2-obrońcy, 3-pomocnicy, 4-napastnicy):</p>
        <form action="futbol.php" method="post">
            <input type="number" name="pozycja" id="">
            <button type="submit">Sprawdź</button>
        </form>
        <ul>
        <?php
            if (isset($_REQUEST['pozycja']) && $_REQUEST['pozycja'] != "") { //za pomocą $_REQUEST[''] dostajemy się do formularza i podajemy nazwę zmiennej ($_REQUEST, by default, contains the contents of $_GET, $_POST and $_COOKIE). Najpierw sprawdzamy za pomocą 'isset' czy zostało przesłane z formularza, a następnie czy ta sama funkcja nie jest pusta (stąd &&)
                $sql = $connect->prepare("SELECT imie, nazwisko FROM zawodnik WHERE pozycja_id = ?"); //mogę nadal się odwołać do bazy danych ($connect) bo zamykam ją dopiero na dole (linijka 68). Podstawianie wartości za pomocą 'prepare' wygląda w ten sposób, że kopiujemy żądaną kwerendę i dajemy znak '?'
                $sql->bind_param("i", $_REQUEST['pozycja']); //następnie wykonujemy funkcję 'bind_param', która pozwala nam podstawić wartość (u nas "i") i następnie $_REQUEST['pozycja'] z formularza
                $sql->execute(); //wywołujemy kwerendę za pomocą 'execute()'
                $result = $sql->get_result(); //pobieram do '$result'
                while($row = $result->fetch_assoc()) { //iteruję przez pętlę 'while'
                    $imie = $row['imie'];
                    $nazwisko = $row['nazwisko'];
                    echo "<li>$imie $nazwisko</li>";
                }
            }
            ?>
        </ul>
    </div>
    <div id="prawy">
        <img src="zad1.png" alt="piłkarz">
        <p>Autor: TEACHER</p>
    </div>
    <?php
    $connect->close();
    ?>
    
</body>

</html>