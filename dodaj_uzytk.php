<?PHP

$NICK = $_REQUEST['NICK'];
$KONTAKT = $_REQUEST['KONTAKT'];
$WIEK = $_REQUEST['WIEK'];
$IMIE = $_REQUEST['IMIE'];
$NAZWISKO = $_REQUEST['NAZWISKO'];
$PLEC = $_REQUEST['PLEC'];
$RANKING = $_REQUEST['RANKING'];
$PREFEROWANY_KOLOR = $_REQUEST['PREFEROWANY_KOLOR'];
$ULUBIONE_OTWARCIE = $_REQUEST['ULUBIONE_OTWARCIE'];
$ULUBIONY_SZACHISTA = $_REQUEST['ULUBIONY_SZACHISTA '];
$PREF_PORA = $_REQUEST['PREF_PORA'];
$PREF_RANKING_PRZECIWNIKA = $_REQUEST['PREF_RANKING_PRZECIWNIKA'];
$PREF_WIEK_PRZECIWNIKA = $_REQUEST['PREF_WIEK_PRZECIWNIKA'];


$sqltext = "INSERT INTO UZYTKOWNIK VALUES (SELECT max(ID)+1 FROM UZYTKOWNIK, '" . $NICK ."', '" .$KONTAKT. "','" .$WIEK."', '" .$IMIE."', '".$NAZWISKO."',  '" .$PLEC."', '" .$RANKING."', '" . $PREFEROWANY_KOLOR ."', 7, 5, '" .$PREF_PORA."', '" .$PREF_RANKING_PRZECIWNIKA."', '" .$PREF_WIEK_PRZECIWNIKA."')";

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

$stmt = oci_parse($conn, $sqltext);

oci_execute($stmt, OCI_NO_AUTO_COMMIT);
oci_commit($conn);
oci_close($conn);

header("Location:". $_SERVER['HTTP_REFERER']);
?>









