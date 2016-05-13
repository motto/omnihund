<?php
defined( '_MOTTO' ) or die( 'Restricted access' );
function betolt($className)
{
    $className = ltrim($className, '\\');
    $fileName  = '';
    $namespace = '';
    if ($lastNsPos = strrpos($className, '\\')) {
        $namespace = substr($className, 0, $lastNsPos);
        $className = substr($className, $lastNsPos + 1);
        $fileName  = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
    }
    $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';
     $fileName =strtolower($fileName);//saját (kisbetűsítés) nem igazán kell
    if(is_file($fileName)) {require $fileName;}
    //echo $fileName;
}
function betolt2($className)
{
  $classT= explode('_',$className);
    betolt($classT[0]);
}
spl_autoload_register('betolt');
spl_autoload_register('betolt2');
class CONF
{
    public static $sql_log='full';//lehet 'no','parancs': a lekérdezéseket nem
    public static $accepted_langT=array('en','hu');
    public static $tmpl='flat';
    public static $title='Omnihund';
    public static $upload_dir='user/share';
    public static $adminok=array(1,2);
    public static $host = 'localhost';
    public static $felhasznalonev = 'root';
    public static $jelszo = '';
    public static $adatbazis = 'omnihund';
    public static $mailfrom= 'motto001@gmail.com';
    public static $fromnev= 'Admin';
    public static $offline = 'nem';
    public static $offline_message = 'Weblapunk fejlesztés alatt.';
}

class GOB
{ 
	private static $userjog=Array();public static $app='login';
    public static $lang='en';
    public static $log=Array();
    public static $userT=Array();
    /**
     * @var string ez alapján kéredzi le az usrtömböt($userT)
     */
    public static $user_mezok='id,kifcim,username,email,password';
    public static $log_mod=true;
    public static $db=null;
    public static $LT=array(); //nyelvi tömb
    public static $hiba=array();
    public static $param=array();
    public static $html=null;
    public static $head=[];
    public static $body=[];
    /**
     * @var string
     * '' (alapértelmezés) az adminok csak saját cikkeiket szerkeszthetik
     * 'kozos' az adminok egymás cikkeit szerkeszthetik
     * 'tulajdonos' Az adminok szerkeszthetnek minden cikket
     */
    public static $admin_mod='';
    public static function get_userjog($jogname){
        if(in_array($jogname,self::$userjog)){return true;}
        else{return false;}
    }
    public static function set_userjog(){
        self::$userjog=\lib\jog\Jog::fromGOB();
    }

}
