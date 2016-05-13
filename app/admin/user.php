<?php
namespace app\admin;
use lib\db\DB;
use mod\MOD;
include 'app/admin/trt/trt.php';
class PAR
{
public static $datatomb_sql="SELECT id,username,datum,ellenorzott,pub FROM userek WHERE id<>'1' or id<>'2'";
public static $ikonsor = array('pub','unpub','torol','email');
public static $tablanev='userek';
public static $tabla_szerk =array(
    array('cim'=>'','mezonev'=>'','tipus'=>'checkbox'),
    array('cim'=>'','mezonev'=>'pub','tipus'=>'pubmezo'),
    array('cim'=>'id','mezonev'=>'id','tipus'=>''),
    array('cim'=>'Usernev','mezonev'=>'username','tipus'=>''),
    array('cim'=>'Reg. Dátum','mezonev'=>'datum','tipus'=>''),
    array('cim'=>'Ellenőrzött?','mezonev'=>'ellenorzott','tipus'=>'')
);
	public static $jog='admin';


}

class ADT
{
	public static $idT = [];
	public static $langT=['hu'];
	public static $LT = array();//alap nelvi elemei (menük,gombok stb)
	public static $dataT = array();//a szerkesztendő adatok
	public static $dataLT = array();//a szerkesztendő adatok nyelvi elemi
	public static $view = '<form   method="post" ><!--|ikonsor|--><!--|tabla|--></form>';
}
class Admin
{
	use  torol, pub, unpub, joghiba, cancel;


	public function __construct()
	{   ADT::$idT[0]=0;
	if(isset($_POST['sor']))
	{
		ADT::$idT=$_POST['sor'];
	}
	if(isset($_POST['id']))
	{
		ADT::$idT[0]=$_POST['id'];
	}
	
	}
	public function alap()
	{
		ADT::$dataT=DB::assoc_tomb(PAR::$datatomb_sql);
		$datatabla=MOD::tabla(PAR::$tabla_szerk,ADT::$dataT);
		$ikonsor=MOD::ikonsor(PAR::$ikonsor);
		ADT::$view=str_replace('<!--|tabla|-->', $datatabla, ADT::$view );
		ADT::$view=str_replace('<!--|ikonsor|-->', $ikonsor, ADT::$view );
	}
};

$app=new Admin();$fn='alap';
if(isset($_GET['task'])){$fn=$_GET['task'];}
if(isset($_POST['task'])){$fn=$_POST['task'];}
//echo $fn;
if(!in_array($_SESSION['userid'],\CONF::$adminok)){$fn='joghiba';}
//echo $fn;
$app->$fn();

//\GOB::$html= str_replace('<!--|tartalom|-->',ADT::$view,\GOB::$html);



