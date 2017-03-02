<?php
header('Content-Type: audio/mpeg; charset=ISO-8859-1');
//header('Content-Type: application/json; charset=ISO-8859-1');
error_reporting(E_ALL ^ E_NOTICE);
$request = strtolower(trim(utf8_decode($_GET["text"])));
$silent_at_end = strtolower(trim(utf8_decode($_GET["sae"])));
$request_array = explode(" ",$request);

$vocals = array("a","e","i","u","o","ä","ö","ü");

$double_cons = array("s","t","m","l","f","r","p");

$data="";

foreach ($request_array as $current_request) {
  $cwa= str_split($current_request);
  for($i=0;$i<count($cwa);$i++) {
    $character = $cwa[$i];
    if($character=="s"&&$cwa[$i+1]=="c"&&$cwa[$i+2]=="h"&&$cwa[$i-1]!="s"){ //Detect "sch"
      $data .= file_get_contents('audio/de_CH/sch.mp3');
      $i=$i+2;
    }else if($character=="c"&&$cwa[$i+1]=="h"){ //Detect "ch"

      $i=$i+1;
    }else if($character=="p"&&$cwa[$i+1]=="h"){ //Detect "ph"

      $i=$i+1;
    }else if($character=="s"&&$cwa[$i+1]=="t"&&!in_array($cwa[$i-1],$vocals)&&!in_array($cwa[$i-1],$double_cons)){ //Detect "st"

      $i=$i+1;
    }else if($character=="e"&&$cwa[$i+1]=="i"){ //Detect "ei"
      $data .= file_get_contents('audio/de_CH/ei.mp3');
      $i=$i+1;
    }else if($character=="e"&&$cwa[$i+1]=="u"){ //Detect "eu"

      $i=$i+1;
    }else if($character=="a"&&$cwa[$i+1]=="u"){ //Detect "au"
      $i=$i+1;
    }else if($character=="ä"&&$cwa[$i+1]=="u"){ //Detect "äu"
      $i=$i+1;
    }else if($character=="c"&&$cwa[$i+1]=="k"){ //Detect "ck"
      $i=$i+1;
    }else if($character=="o"&&$cwa[$i+1]=="u"){ //Detect "ou"
      $i=$i+1;
    }else if($character=="p"&&$cwa[$i+1]=="f"){ //Detect "pf"
      $data .= file_get_contents("audio/de_CH/pf.mp3");
      $i=$i+1;
    }else{ //All other normal characters
      if(($i+1)==count($cwa)){ //Last character in word
        switch($character){
          case "a":
            $data .= file_get_contents("audio/de_CH/a.mp3");
            break;
          case "b":
            $data .= file_get_contents('audio/de_CH/b.mp3');
            break;
          case "c":
            break;
          case "d":
            break;
          case "e":
            $data .= file_get_contents('audio/de_CH/e_down.mp3');
            break;
          case "f":
            break;
          case "g":
            break;
          case "h":
            break;
          case "i":
            break;
          case "j":
            break;
          case "k":
            break;
          case "l":
            $data .= file_get_contents("audio/de_CH/l_down.mp3");
            break;
          case "m":
            break;
          case "n":
            $data .= file_get_contents('audio/de_CH/n_down.mp3');
            break;
          case "o":
            break;
          case "p":
            break;
          case "q":
            break;
          case "r":
            break;
          case "s":
            break;
          case "t":
            break;
          case "u":
            break;
          case "v":
            break;
          case "w":
            break;
          case "x":
            break;
          case "y":
            break;
          case "z":
            break;
        }
      }else{
        switch($character){
          case "a":
            $data .= file_get_contents("audio/de_CH/a.mp3");
            break;
          case "b":
            $data .= file_get_contents('audio/de_CH/b.mp3');
            break;
          case "c":
            break;
          case "d":
            break;
          case "e":
            $data .= file_get_contents('audio/de_CH/e.mp3');
            break;
          case "f":
            break;
          case "g":
            break;
          case "h":
            break;
          case "i":
            $data .= file_get_contents('audio/de_CH/i.mp3');
            break;
          case "j":
            break;
          case "k":
            break;
          case "l":
            break;
          case "m":
            $data .= file_get_contents('audio/de_CH/m.mp3');
            break;
          case "n":
            $data .= file_get_contents('audio/de_CH/n.mp3');
            break;
          case "o":
            break;
          case "p":
            break;
          case "q":
            break;
          case "r":
            break;
          case "s":
            $data .= file_get_contents('audio/de_CH/s.mp3');
            break;
          case "t":
            break;
          case "u":
            break;
          case "v":
            break;
          case "w":
            break;
          case "x":
            break;
          case "y":
            break;
          case "z":
            break;
        }
      }
      echo "_$character";
    }
  }
  echo " ";
}
if(boolval($silent_at_end) == true){
  $data .= file_get_contents('audio/de_CH/silent.mp3');
}

//Set header for output
header("Content-Length:".strlen($data));
echo $data; //Output new audio file.
?>
