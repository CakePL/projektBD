<HTML>
  <HEAD>
    <TITLE> Genealogia matematyczna - Naukowcy </TITLE>
  </HEAD>
  <BODY>
    <H2> Naukowcy </H2>
    <?PHP 
      //////////////////////////////////
      // Tworzenie ciasteczka sesyjnego.
      session_start();
      // Zapisanie loginu i hasla w ciasteczku sesyjnym.
      $_SESSION['LOGIN'] = $_POST['LOGN'];
      $_SESSION['PASS'] = $_POST['PASW'];
      ///////////////////////////////////
      // Nawiazywanie polaczenia; login i haslo do postgresa studenckiego. DziaĹa scott/tiger
      $conn = pg_connect("host=labdb dbname=bd user=".$_SESSION['LOGIN']." password=".$_SESSION['PASS']);
      // Wykonywanie zapytania SQL-owego
      $query = pg_query($conn, "SELECT * FROM naukowiec");
      // Pobierz kolejny wiersz; tablica jest zarowno asocjacyjna, jak i zwykla
      while ($row = pg_fetch_array($query)) {
        // Use lowercase column names for the associative array indices and numbers for the ordinary array indices.
        echo "<BR><A HREF=\"doktoranci.php?id=".$row['id']."\">". $row[1] ." ".$row['nazwisko']."<A><BR>\n";
      }
      // Zamkniecie polaczenie z baza.
      pg_close($conn);
    ?>
  </BODY>
</HTML>