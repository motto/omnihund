<?php
namespace mod;
use lib\html\FeltoltS;
use mod\ikonsor\Ikonsor;
use mod\login\Login;
use mod\tabla\Tabla;
use mod\zaszlo\Zaszlo;

defined( '_MOTTO' ) or die( 'Restricted access' );
class MOD
{
public static function zaszlo($param='')
{
   // include_once 'mod/zaszlo/zaszlo.php';
    $zaszlo=new Zaszlo();
    return $zaszlo->eng_hu();
}


public static function login($param='')
    {
       //  include_once 'mod/login/login.php';
        $login=new Login();
        $view=$login->result();
        $view=FeltoltS::LT($view,'ModLT');
            return $view;
    }
public static function ikonsor($param='')
    {
        //include_once 'mod/ikonsor/ikonsor.php';
        $ob=new Ikonsor();
       // $ob->mezok=$ikonok;
        return $ob->result($param::$ikonsorT);
    }
public static function tabla($param='')
    { //var_dump($param);
        //print_r($param);
        //include_once 'mod/tabla/tabla.php';
        $ob=new Tabla($param::$tab_szerkT,$param::$dataT);
        return $ob->result();
    }
}