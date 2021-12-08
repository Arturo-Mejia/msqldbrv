<?php
 
$url = "http://amhweb.ddns.net/mysql/consultar.php?email=".$_GET["email"]."&pass=".$_GET["pass"];

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

//for debug only!
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

$resp = curl_exec($curl);

if (!curl_errno($curl)) {
  switch ($http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE)) {
    case 200:  # OK
    $stc=200; 
      break;
    default:
      $stc=$http_code;
  }
}
curl_close($curl);

if($stc==200)
{
  if($resp=="Sin resultados")
  {
    echo "0";
  } else
  { 
    $jsond=json_decode($resp,true);
  
  foreach($jsond["dbremota"] as $midb)
  {

    $hostname="amhweb.ddns.net";
    $username=$midb["dbuser"];
    $pass=$midb["dbpass"];
    $database=$midb["dbname"];
  } 

  echo '<input id="hostname" type="hidden" value="amhweb.ddns.net">';
  echo '<input id="username" type="hidden" value="'.$username.'">';
  echo '<input id="userpass" type="hidden" value="'.$pass.'">';
  echo '<input id="databasename" type="hidden" value="'.$database.'">'; 

  }
  
}
   

  ?>
    