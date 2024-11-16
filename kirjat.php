<?php
include 'yla.php';
include 'ala.php';
echo"<br><br>";
$dsn = "pgsql:host=localhost;dbname=lsaarinen";
$user = "db_lsaarinen";
$pass = getenv('DB_PASSWORD');
$options = [PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION];

try {
$yht = new PDO($dsn, $user, $pass, $options);
if (!$yht) echo $e->getMessage(); 
   

    /*$stmt = $yht->query("SELECT nimi,kirjaid
    FROM kirja,kirjailija,genre,kustantaja"); 
   while ($rivi = $stmt->fetch()) {*/ 
    $stmt = $yht->query("select k.nimi, ki.etunimi,
    ki.sukunimi,k.vuosi,
    g.gnimi, ku.knimi,ku.wwwsivu
     from kirja as k, kirjailija as ki, kustantaja as ku, genre as g where k.tekijäid=ki.tekijäid and ku.kustid=k.kustid and k.genreid=g.genreid order by ki.sukunimi asc;");
     //$rivi = $stmt->fetch(); 
//echo "<font color= 'black'";
//echo "<b>";
//echo "<hr>";
//$rivi = $stmt->fetch() ;
echo " KAIKKI KIRJAT:<br>(aakkosjärjestys kirjailijan sukunimen mukaan)<br>";
while ( $rivi = $stmt->fetch() ) {
   /* echo "<div class='kirjat'>";
    echo " <div>Nimi: $rivi[nimi]</div>"; 
    
    echo " <div>Genre: $rivi[gnimi]</div>"; 
    echo " <div>Vuosi: $rivi[vuosi]</div>"; 
    echo " <div>Miespääosa: $rivi[sukunimi]</div>"; 
    echo " <div>Naispääosa: $rivi[etunimi]</div>"; 
    echo " <div>Ikäraja: $rivi[knimi]</div>"; 
    echo " <div>Kesto: $rivi[wwwsivu]</div>"; 
    echo "<br>";
 */  
echo "<hr> ";
    echo "  Kirjan nimi: $rivi[nimi]<br>";
    echo "  Genre: $rivi[gnimi]<br>";
    echo "  Vuosi: $rivi[vuosi]<br>";
    echo "  Kirjailijan nimi: $rivi[sukunimi]";
    echo "   $rivi[etunimi]<br>";
    echo "  Kirjan kustantaja: $rivi[knimi]<br>";
    echo "  Kustantajan www-sivu: $rivi[wwwsivu]<br>"; 
 
}
}
 catch (PDOException $e) { 
     echo $e->getMessage(); die();
 }
include 'ala.php';
?>
