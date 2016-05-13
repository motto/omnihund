<?php
session_start();
define("DS", "/"); define("_MOTTO", "igen");

use  lib\db ;
use mod\login\LogDataS;
use lib\jog\Azonosit;
use lib\html\Fejlec;
//use  lib\base ;

include 'def.php';
if(CONF::$offline=='igen'&& !GOB::get_userjog('admin.php'))
{die(CONF::$offline_message);}

db\Connect::connect();//GOB::$db-be létrehozza az adatbázis objektumot
//azonosítás-------------
$azon= new \lib\jog\Azonosit();
GOB::$userT=$azon::set_userdata($_SESSION['userid'],'id,username,email,password ');
GOB::set_userjog();

//GOB::$lang=alap\Base::set_lang(GOB::$lang);
//if(isset($_GET['ref'])){$_SESSION['ref']=$_GET['ref'];}

if(isset($_GET['tmpl'])){GOB::$tmpl=$_GET['tmpl'];}

GOB::$head['jsfile']['jqery']='lib/js/jquery-1.9.1.min.js';
GOB::$head['jsfile']['bootstrap']='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js';
GOB::$head['cssfile']['bootstrap']='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css';

//adatbázis---------------

if(isset($_POST['ltask']) && $_POST['ltask']=='belep'){LogDataS::belep();}
if(isset($_POST['ltask']) && $_POST['ltask']=='kilep'){ $_SESSION['userid'] = 0;}

//applikáció becsatolás-----------------------------

if(isset($_POST['app'])){GOB::$app=$_POST['app'];}
if(isset($_GET['app'])){GOB::$app=$_GET['app'];}
include_once 'app/'.GOB::$app.'/'.GOB::$app.'.php';
$headscript=Fejlec::res(GOB::$head);
$bodyscript=Fejlec::res(GOB::$body);
GOB::$html= str_replace('<!--|headscript|-->',$headscript ,GOB::$html);
GOB::$html= str_replace('<!--|bodyscript|-->',$bodyscript ,GOB::$html);
echo GOB::$html;
