<?php
include 'yla.php';
include 'ala.php';
echo "<hr>";
echo "<br>";
$dsn = "pgsql:host=localhost;dbname=lsaarinen";
$user = "db_lsaarinen";
$pass = getenv('DB_PASSWORD');
$options = [PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION];

try {
$yht = new PDO($dsn, $user, $pass, $options);
if (!$yht) echo $e->getMessage(); 
 /*  
$stmt = $yht->query
("select a.asiakasid, lr.lainausid, lr.kirjaid, la.asiaksid
from  asiakas as a,  lainausrivi as lr, lainaus as la, kirja as k

 where la.asiaksid = a.asiakasid
 and lr.lainausid = la.lainausid
 and la.asiaksid = lr.lainausid
and lr.kirjaid = k.kirjaid
 order by lr.kirjaid asc, lr.lainausid asc");
 //$rivi = $stmt->fetch();
 while ($rivi = $stmt->fetch()) {
 echo "Suosituimman kirjan id";
 echo $rivi['kirjaid'];
     
        $stmt = $yht->query("select k.nimi, lr.lainausid, lr.kirjaid
from  kirja as k, lainausrivi as lr, lainaus as la
 where lr.lainausid = la.lainausid
and lr.kirjaid = k.kirjaid
 order by lr.kirjaid desc");
   while ($rivi = $stmt->fetch()) { */
    $stmt = $yht->query("select kirja.nimi, count (lainausrivi.kirjaid) as lainauskerrat from kirja inner join lainausrivi on kirja.kirjaid= lainausrivi.kirjaid group by lainausrivi.kirjaid, kirja.nimi order by lainauskerrat desc");
   /* $stmt = $yht->query
    ("SELECT lainausrivi.kirjaid, kirja.nimi,
    COUNT (lainausrivi.kirjaid) as lainausrivi FROM kirja inner
    JOIN lainausrivi ON kirja.kirjaid = lainausrivi.kirjaid 
GROUP BY lainausrivi.kirjaid, kirja.nimi order by lainausrivi desc;");
    /*$stmt = $yht->query("select kirjaid, count(*) as count
    from  lainausrivi
   group by kirjaid
     order by count desc");
     echo "Eniten lainattujen kirjojen id:t <br><br>";
       while ($rivi = $stmt->fetch()) { 
    //$stmt = $yht->query("SELECT lainausid
    //FROM lainausrivi"); */
    echo "Suosituimmat kirjat:<br><br>";
   while ($rivi = $stmt->fetch()) { 
    echo "<font color= 'black'";
    
    echo " <div>$rivi[nimi]</div>";
    echo " <div>lainauskerrat: $rivi[lainauskerrat]</div>";
    echo "<br><br>";
    
    
    //echo " <div>- $rivi[kirjaid]<br><br>";
   // echo " <div>lainausid: $rivi[lainausid]</div>";
    
    //echo " <div>Nimi: $rivi[kirjaid]</div>"; 
    
   
   }
   }
//}
 catch (PDOException $e) { 
     echo $e->getMessage(); die();
 }
 echo "<hr>";
 
?>