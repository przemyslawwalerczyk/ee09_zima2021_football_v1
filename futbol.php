<!--https://www.youtube.com/watch?v=pcxmSDEf6WI plus w komemtarzach link do repozytorium GIT -->


<!DOCTYPE html>
<html lang="pl-PL">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rozgrywki futbolowe</title>
    <link rel="stylesheet" href="styl.css">
</head>

<body>
    <header id="baner">
        <h1>Światowe rozgrywki piłkarskie</h1>
        <img src="boisko.png" alt="boisko" />
    </div>

    <section id="mecze">
        <div id="mecz"></div>

        <?php
        require_once "connect.php";
        $connect = new mysqli($host, $db_user, $db_pass, $db_name);
        $sql = "SELECT zespol1, zespol2, wynik, data_rozgrywki FROM rozgrywka WHERE zespol1 = 'EVG'";
        $result = $connect->query($sql);

        while ($row = $result->fetch_assoc()) {
            $zespol1 = $row['zespol1'];
            $zespol2 = $row['zespol2'];
            $wynik = $row['wynik'];
            $data = $row['data_rozgrywki'];

            echo "<h3>$zespol1 - $zespol2</h3>";
            echo "<h4>$wynik</h4>";
            echo "<p>$data</p>";
        }
        
        ?>
    </section>
    <main>
        <h2>Reprezentacja Polski</h2>
    <main>
    <div id="lewy">
        <p>Podaj pozycję zawodników (1-bramkarze, 2-obrońcy, 3-pomocnicy, 4-napastnicy) </p>
        <form action="futbol.php" method="post">
            <input type="number" name="num">
            <button type="submit">Sprawdź</button>
        </form>

        <ul>
            <?php
            require_once "connect.php";
            $connect = new mysqli($host, $db_user, $db_pass, $db_name);
            $sql = "SELECT imie, nazwisko FROM zawodnik WHERE pozycja_id = 3";
            $result = $connect->query($sql);

            while ($row = $result->fetch_assoc()) {
                $imie = $row['imie'];
                $nazwisko = $row['nazwisko'];
                echo "<li>$imie $nazwisko</li>";
            }
            $connect->close();
            ?>
        </ul>
    </div>

    <div id="prawy">
        <img src="piłka.png" alt="piłka" />
        <p>Autor: TEACHER</p>
    </div>
    <?php
        $connect->close();
    ?>

</body>

</html>