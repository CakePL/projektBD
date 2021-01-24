<HTML>
<HEAD>
  <link rel="stylesheet" href="styles.css">
  <link rel="icon" href="icon.jpg">
  <TITLE> Chess-dating </TITLE>
</HEAD>
<BODY>
  <a href="https://students.mimuw.edu.pl/~bs418386/bd/home.php">
  Strona główna </a>
<H2> Lista Użytkowników </H2>

<?PHP

session_start();

$_SESSION['LOGIN'] = 'bs418386';
$_SESSION['PASS'] = 'bs418386';
$_SESSION['CONNSTR'] = "//labora.mimuw.edu.pl/LABS";


$conn = oci_connect($_SESSION['LOGIN'],$_SESSION['PASS'], $_SESSION['CONNSTR']);
if (!$conn) {
   echo "oci_connect failed\n";
   $e = oci_error();
   echo $e['message'];
}
?>


<?PHP
$sql_text = "SELECT U.ID, U.NICK, U.IMIE AS IM, U.NAZWISKO AS NA, U.WIEK, U.KONTAKT, U.RANKING,  U.PREFEROWANY_KOLOR, O.NAZWA, S.IMIE, S.NAZWISKO  FROM UZYTKOWNIK U, OTWARCIE O, SLAWNY_SZACHISTA S WHERE U.ULUBIONE_OTWARCIE = O.ID AND U.ULUBIONY_SZACHISTA = S.ID ORDER BY U.ID";

$stmt = oci_parse($conn, $sql_text);

oci_execute($stmt, OCI_NO_AUTO_COMMIT);
?>

<div style="height: 90%;  overflow: auto; float: left;">
  <table class="center">
    <tr>
      <th>ID</th>
      <th>Nick</th>
      <th>Imię</th>
      <th>Nazwisko</th>
      <th>Wiek</th>
      <th>Kontakt</th>
      <th>Ranking</th>
      <th>Preferowany Kolor</th>
      <th>Ulubione Otwarcie</th>
      <th>Ulubiony </th>
      <th>Szachista</th>
      

    </tr>

    <?PHP
    while (($row = oci_fetch_array($stmt, OCI_BOTH))) {
       echo "<tr>";
       echo "<td>${row['ID']}</td>\n";
       echo "<td>${row['NICK']}</td>\n";
       echo "<td>${row['IM']}</td>\n";
       echo "<td>${row['NA']}</td>\n";
       echo "<td>${row['WIEK']}</td>\n";
       echo "<td>${row['KONTAKT']}</td>\n";
       echo "<td>${row['RANKING']}</td>\n";
       echo "<td>${row['PREFEROWANY_KOLOR']}</td>\n";
       echo "<td>${row['NAZWA']}</td>\n";
       echo "<td>${row['IMIE']}</td>\n";
       echo "<td>${row['NAZWISKO']}</td>\n";

       

       echo "</tr>\n";


    }
    ?>

  </table>
</div>


<div style="float: right;"><H2> 
Dodaj Użytkownika</H2>
<form method = "post">

  <label for="NICK">Nick</label>
  <input type="text" name="NICK"><br>

  <label for="IMIE">Imię</label>
  <input type="text" name="IMIE"><br>

  <label for="NAZWISKO">Nazwisko</label>
  <input type="text" name="NAZWISKO"><br>

  <label for="WIEK">Wiek</label>
  <input type="number" name="WIEK"><br>

  <label for="PLEC">Płeć</label>
  <select  name="PLEC">
    <option value="mezczyzna"> Mężczyzna</option>
    <option value="kobioeta">Kobieta</option>
  </select><br>

  <label for="KONTAKT">Kontakt</label>
  <input type="KONTAKT" name="KONTAKT"><br>

  <label for="RANKING">Ranking</label>
  <input type="number" name="RANKING"><br>

  <label for="PREFEROWANY_KOLOR">Preferowany Kolor</label>
  <select name="PREFEROWANY_KOLOR">   
    <option value="czarny"> Czarny</option>
    <option value="bialy">Biały</option>
  </select><br>

  <label for="ULUBIONE_OTWARCIE">Ulubione Otwarcie</label>
  <input type="text" name="ULUBIONE_OTWARCIE"><br>

  <label for="ULUBIONY_SZACHISTA">Ulubiony Szachista</label>
  <input type="text" name="ULUBIONY_SZACHISTA"><br>

  <label for="PREF_PORA">Preferowana pora rozgrywek</label>
  <select name="PREF_PORA">
    <option value="rano"> Rano</option>
    <option value="poludnie">Południe</option>
    <option value="popoludnie"> Popołudnie</option>
    <option value="wieczor">Wieczór</option>
    <option value="noc">Noc</option>
  </select><br>

  <label for="PREF_RANKING_PRZECIWNIKA">Preferowany ranking przeciwnika</label>
  <input type="text" name="PREF_RANKING_PRZECIWNIKA"><br>  

  <label for="PREF_WIEK_PRZECIWNIKA">Preferowany wiek przeciwnika</label>
  <input type="number" name="PREF_WIEK_PRZECIWNIKA"><br> 


  <button type="submit" formaction="dodaj_uzytk.php">Dodaj użytkownika</button>

</form>
</div>



<?PHP
oci_close($conn);
?>

</BODY>
</HTML>











