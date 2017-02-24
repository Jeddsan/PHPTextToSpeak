<?php
header('Content-Type: text/html; charset=ISO-8859-1');
error_reporting(E_ALL ^ E_NOTICE);
$request = strtolower(trim(utf8_decode($_GET["text"])));
$request_array = explode(" ",$request);

$vocals = array("a","e","i","u","o","ä","ö","ü");

$double_cons = array("s","t","m","l","f","r","p");

foreach ($request_array as $current_request) {
  $cwa= str_split($current_request);
  for($i=0;$i<count($cwa);$i++) {
    $character = $cwa[$i];
    if($character=="s"&&$cwa[$i+1]=="c"&&$cwa[$i+2]=="h"&&$cwa[$i-1]!="s"){ //Detect "sch"
      echo "_sch";
      $i=$i+2;
    }else if($character=="c"&&$cwa[$i+1]=="h"){ //Detect "ch"
      echo "_ch";
      $i=$i+1;
    }else if($character=="p"&&$cwa[$i+1]=="h"){ //Detect "ph"
      echo "_ph";
      $i=$i+1;
    }else if($character=="s"&&$cwa[$i+1]=="t"&&!in_array($cwa[$i-1],$vocals)&&!in_array($cwa[$i-1],$double_cons)){ //Detect "st"
      echo "_scht";
      $i=$i+1;
    }else if($character=="e"&&$cwa[$i+1]=="i"){ //Detect "ei"
      echo "_ei";
      $i=$i+1;
    }else if($character=="e"&&$cwa[$i+1]=="u"){ //Detect "eu"
      echo "_eu";
      $i=$i+1;
    }else if($character=="a"&&$cwa[$i+1]=="u"){ //Detect "au"
      echo "_au";
      $i=$i+1;
    }else if($character=="ä"&&$cwa[$i+1]=="u"){ //Detect "äu"
      echo "_äu";
      $i=$i+1;
    }else if($character=="c"&&$cwa[$i+1]=="k"){ //Detect "ck"
      echo "_kk";
      $i=$i+1;
    }else if($character=="o"&&$cwa[$i+1]=="u"){ //Detect "ck"
      echo "_uu";
      $i=$i+1;
    }else{ //All other normal characters
      echo "_$character";
    }
  }
  echo " ";
}
?>
