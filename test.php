<?php

use lib\base\ObMo_St;

session_start();
define("DS", "/"); define("_MOTTO", "igen");
//use  lib\db ;

include 'def.php';
//db\Connect::connect();//GOB::$db-be létrehozza az adatbázis objektumot

//include 'test/mod/login/t_login.php';
class GOBT{
	
	static public $resT=[];
}

//include 'test/lib/ell/t_ell.php';
//include 'test/lib/base/t_base.php';
//include 'test/lib/itemview/t_itemview.php';
if(empty(GOBT::$resT)){echo 'a tesztek sikeresen lefutottak!';}else{
echo"A kovetkező tesztek nem futottak le sikeresen: \n";
foreach(GOBT::$resT as $clas=>$func){ echo 'class:'.$clas.' func: ';}	
foreach($func as $funcnev=>$val){ echo $funcnev.",".$val.'; ';}
echo "\n";
}

//ObMo_St::res();