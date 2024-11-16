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

$stmt = $yht->query("select kirja.nimi, count (lainausrivi.kirjaid) as lainauskerrat from kirja inner join lainausrivi on kirja.kirjaid= lainausrivi.kirjaid group by lainausrivi.kirjaid, kirja.nimi order by lainauskerrat desc");

echo "Suosituimmat kirjat:<br><br><br>";
echo "<table style='widht:auto'>" ;
echo "<b><tr style='text-aling:left'><td>Lainauskertojen lkm<th><td>nimi<th>";
echo " <tr><td>";
while ($rivi = $stmt->fetch()) { 
  echo " <tr><td>";
  echo $rivi['lainauskerrat'] ;
  echo "<td><td>"; 
  echo $rivi['nimi'];
  echo "<td><td>";
  

}
}

catch (PDOException $e) { 
  echo $e->getMessage(); die();
}
echo "<hr>";

?>


