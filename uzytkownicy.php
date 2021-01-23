<HTML>
<HEAD>
  <link rel="stylesheet" href="styles.css">
  <link rel="icon" href="icon.jpg">
  <TITLE> Chess-dating </TITLE>
</HEAD>
<BODY>
  <a href="https://students.mimuw.edu.pl/~bs418386/bd/home.php">
  Strona główna </a>
<H2> Użytkownicy </H2>

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





<?php

$sql_text = "SELECT U.ID, U.NICK, U.RANKING, U.PREFEROWANY_KOLOR, O.NAZWA, S.IMIE, S.NAZWISKO  FROM UZYTKOWNIK U, OTWARCIE O, SLAWNY_SZACHISTA S WHERE U.ULUBIONE_OTWARCIE = O.ID AND U.ULUBIONY_SZACHISTA = S.ID";

if ($_GET['sort'] == 'ID')
{
    $sql_text .= " ORDER BY U.ID";
}
elseif ($_GET['sort'] == 'NICK')
{
    $sql_text .= " ORDER BY U.NICK";
}
elseif ($_GET['sort'] == 'RANKING')
{
    $sql_text .= " ORDER BY U.RANKING";
}
elseif($_GET['sort'] == 'NAZWA')
{
    $sql_text .= " ORDER BY O.NAZWA";
}
elseif($_GET['sort'] == 'IMIE')
{
    $sql_text .= " ORDER BY S.IMIE";
}
elseif($_GET['sort'] == 'NAZWISKO')
{
    $sql_text .= " ORDER BY  S.NAZWISKO";
}
?>



<?PHP
$stmt = oci_parse($conn, $sql_text);

// Wykonywanie wyrazenia SQL-owego
oci_execute($stmt, OCI_NO_AUTO_COMMIT);
?>

<div style="height: 90%;  overflow: auto; float: left; ">
  <table class="center"  style='font-size:25px'>
    <tr>
      <th><a href="uzytkownicy.php?sort=ID">ID</a></th>
      <th><a href="uzytkownicy.php?sort=NICK">Nick</a></th>
      <th><a href="uzytkownicy.php?sort=RANKING">Ranking</th>
      <th><a href="uzytkownicy.php?sort=PREFEROWANY_KOLOR">Preferowany Kolor</a></th>
      <th><a href="uzytkownicy.php?sort=NAZWA">Ulubione Otwarcie</a></th>
      <th><a href="uzytkownicy.php?sort=IMIE">Ulubiony </a></th>
      <th><a href="uzytkownicy.php?sort=NAZWISKO">Szachista</a></th>
      

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











