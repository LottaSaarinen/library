  
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
     
  
  $stmt = $yht->query ("select asiakas.sukunimi, asiakas.etunimi, count (lainaus.asiakasid) as lainauskerrat from asiakas inner join lainaus on asiakas.asiakasid= lainaus.asiakasid group by asiakas.sukunimi, asiakas.etunimi order by lainauskerrat desc");
echo "Aktiivisimmat lainaajat<br><br><br>";
echo "<table style='widht:auto'>" ;
echo "<tr style='display:flex'><tr style='text-aling:center'><tr style='aling-items:center'><th>Lainauskertojen lkm <th><th>Sukunimi<th><th>Etunimi</th>";
echo " <tr><td>";
while ($rivi = $stmt->fetch()) { 
    echo " <tr><td>";
    echo $rivi['lainauskerrat'] ;
    echo "<td><td>"; 
    echo $rivi['sukunimi'];
    echo "<td><td>";
    echo $rivi['etunimi'];
    echo "<td><td>";

   /* while ($rivi = $stmt->fetch()) { 
      echo " <tr><td>";
      echo $rivi['sukunimi'] ;}
      while ($rivi = $stmt->fetch()) { 
        echo " <tr><td>";
        echo $rivi['etunimi'] ;}
    /*echo "</tr></td>"; 
    echo $rivi['sukunimi'];
    echo "</tr></td>";
    echo $rivi['etunimi'];
    echo "</tr></td>";
    
    /*?>
 
<html>
  <body>
  <style> 
grid-template-columns: auto auto auto;
grid-gap: 10px;
background-color: wheat;
padding: 10px;


grid-container > div 
background-color: rgb(74, 73, 73);
text-align: center;
padding: 20px 0;
font-size: 30px;

    
       
<div class='grid-container'>
<div class='item2'>lainauskertojen lkm</div>
<div class='item3'>sukunimi</div>
<div class='item4'>etunimi</div>
<div class='item1'>$rivi[lainauskerrat]</div>
<div class='item1'>$rivi[sukunimi]</div>
<div class='item1'>$rivi[etunimi]</div>
  

</div>

</style>
</body>
</html>
<?php*/
}
  }
catch (PDOException $e) { 
    echo $e->getMessage(); die();
}


?>