<HTML>
<HEAD>
  <link rel="stylesheet" href="styles.css">
  <TITLE> Użytkownicy </TITLE>
</HEAD>
<BODY>
  <a href="https://students.mimuw.edu.pl/~bs418386/bd/home.php">
  Strona główna </a>
<H2> Użytkownicy </H2>



<?PHP
$NICK = $_REQUEST['NICK'];
$IMIE = $_REQUEST['IMIE'];
$NAZWISKO = $_REQUEST['NAZWISKO'];
$WIEK = $_REQUEST['WIEK'];
$KONTAKT = $_REQUEST['KONTAKT'];
$RANKING = $_REQUEST['RANKING'];
$PREFEROWANY_KOLOR = $_REQUEST['PREFEROWANY_KOLOR'];
$ULUBIONE_OTWARCIE = $_REQUEST['ULUBIONE_OTWARCIE'];
$ULUBIONY_SZACHISTA = $_REQUEST['ULUBIONY_SZACHISTA '];
$PREF_PORA = $_REQUEST['PREF_PORA'];
$PREF_RANKING_PRZECIWNIKA = $_REQUEST['PREF_RANKING_PRZECIWNIKA'];
$PREF_WIEK_PRZECIWNIKA = $_REQUEST['PREF_WIEK_PRZECIWNIKA'];


$sqltext = "INSERT INTO UZYTKOWNIK (NICK, IMIE, NAZWISKO, WIEK, KONTAKT, RANKING, PREFEROWANY_KOLOR, ULUBIONE_OTWARCIE, ULUBIONY_SZACHISTA, PREF_PORA, PREF_RANKING_PRZECIWNIKA, PREF_WIEK_PRZECIWNIKA)
VALUES ('" . $NICK ."', '" .$IMIE."', '".$NAZWISKO."', '" .$WIEK."', '" .$KONTAKT."', '" .$RANKING."', '" . $PREFEROWANY_KOLOR ."', (SELECT id FROM OTWARCIE WHERE NAZWA = '" .$ULUBIONE_OTWARCIE."'), (SELECT id FROM SLAWNY_SZACHISTA WHERE NAZWISKO = '" .$ULUBIONY_SZACHISTA."'), '" .$PREF_PORA."', $'" .PREF_RANKING_PRZECIWNIKA."', '" .$PREF_WIEK_PRZECIWNIKA."');"


$stmt = oci_parse($conn, $sqltext);

oci_execute($stmt, OCI_NO_AUTO_COMMIT);


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
$stmt = oci_parse($conn, $sqltext);

oci_execute($stmt, OCI_NO_AUTO_COMMIT);

oci_commit($conn);

oci_close($conn);

?>

</BODY>
</HTML>











