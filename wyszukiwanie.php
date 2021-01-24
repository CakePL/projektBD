<HTML>
<HEAD>
  <link rel="stylesheet" href="styles.css">
  <link rel="icon" href="icon.jpg">
  <TITLE> Chess-dating </TITLE>
</HEAD>
<BODY>
  <a href="https://students.mimuw.edu.pl/~bs418386/bd/home.php">
  Strona główna </a>
  <a href="https://students.mimuw.edu.pl/~bs418386/bd/uzytkownicy.php">
  Lista użytkowników</a>
<H1>Idealni oponenci</H1>

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

$WIEK = $_REQUEST['WIEK'];
$PLEC = $_REQUEST['PLEC'];
$RANKING = $_REQUEST['RANKING'];
$PREFEROWANY_KOLOR = $_REQUEST['PREFEROWANY_KOLOR'];
$ULUBIONE_OTWARCIE = $_REQUEST['ULUBIONE_OTWARCIE'];
$ULUBIONY_SZACHISTA = $_REQUEST['ULUBIONY_SZACHISTA'];
$PREF_PORA = $_REQUEST['PREF_PORA'];


$sql_text = "SELECT U.ID, U.NICK, U.RANKING, U.PREFEROWANY_KOLOR, O.NAZWA, S.IMIE, S.NAZWISKO  FROM UZYTKOWNIK U, OTWARCIE O, SLAWNY_SZACHISTA S WHERE U.ULUBIONE_OTWARCIE = O.ID AND U.ULUBIONY_SZACHISTA = S.ID AND (U.WIEK = '" .$WIEK. "' AND  U.PLEC = '" .$PLEC. "' AND U.RANKING = '" .$RANKING. "' AND U.PREFEROWANY_KOLOR = '" .$PREFEROWANY_KOLOR. "' AND  O.NAZWA = '" .$ULUBIONE_OTWARCIE. "' AND S.NAZWISKO = '" .$ULUBIONY_SZACHISTA. "'  AND U.PREF_PORA = '" .$PREF_PORA. "')";


$stmt = oci_parse($conn, $sql_text);

oci_execute($stmt, OCI_NO_AUTO_COMMIT);
?>

<div style="height: 90%;  overflow: auto; float: left; ">
  <table class="center"  style='font-size:25px'>
    <tr>
      <th>ID</th>
      <th>Nick</th>
      <th>Ranking</th>
      <th>Preferowany Kolor </th>
      <th>Ulubione Otwarcie </th>
      <th>Ulubiony </th>
      <th>Szachista</th>
      
    </tr>

    <?PHP
    while (($row = oci_fetch_array($stmt, OCI_BOTH))) {
       echo "<tr>";
       echo "<td>${row['ID']}</td>\n";
       echo "<td>${row['NICK']}</td>\n";
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






<H1>Pozostali dopasowani przeciwniy</H1>

<?PHP


$sql_text2 = "((SELECT U.ID, U.NICK, U.RANKING, U.PREFEROWANY_KOLOR, O.NAZWA, S.IMIE, S.NAZWISKO  FROM UZYTKOWNIK U, OTWARCIE O, SLAWNY_SZACHISTA S WHERE U.ULUBIONE_OTWARCIE = O.ID AND U.ULUBIONY_SZACHISTA = S.ID AND (U.WIEK = '" .$WIEK. "' OR U.PLEC = '" .$PLEC. "' OR U.RANKING = '" .$RANKING. "' OR U.PREFEROWANY_KOLOR = '" .$PREFEROWANY_KOLOR. "' OR O.NAZWA = '" .$ULUBIONE_OTWARCIE. "' OR S.NAZWISKO = '" .$ULUBIONY_SZACHISTA. "'  OR U.PREF_PORA = '" .$PREF_PORA. "')) MINUS (";
$sql_text2.= $sql_text;
$sql_text2.= " ))";


$stmt = oci_parse($conn, $sql_text2);

oci_execute($stmt, OCI_NO_AUTO_COMMIT);
?>

<div style="height: 90%;  overflow: auto; float: left; ">
  <table class="center"  style='font-size:25px'>
    <tr>
      <th>ID</th>
      <th>Nick</th>
      <th>Ranking</th>
      <th>Preferowany Kolor </th>
      <th>Ulubione Otwarcie </th>
      <th>Ulubiony </th>
      <th>Szachista </th>
      

    </tr>

    <?PHP
    while (($row = oci_fetch_array($stmt, OCI_BOTH))) {
       echo "<tr>";
       echo "<td>${row['ID']}</td>\n";
       echo "<td>${row['NICK']}</td>\n";
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


<?PHP
oci_close($conn);
?>


</BODY>
</HTML>


