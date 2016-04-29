<?php
namespace lib\db;
define("_MOTTO", "igen");
//require 'vendor/autoload.php';
require_once 'G:\www\soctest\lib\db\db.php';
require_once 'G:\www\soctest\lib\db\dba.php';
class DBATest
{
    public  function beszur_postbol()
    {

        $mezok['egyes']=[];$mezok['kettes']=[];
        $return="INSERT INTO probatabla (egyes,kettes) VALUES ('','')";
        // $return2=\GOB::$db;

        echo DBA::beszur_postbol('probatabla',$mezok,true)['sql'];
    }
}
$mezok['egyes']=[];$mezok['kettes']=[];
$_POST['egyes']='egyesertek';
echo DBA::beszur_postbol('probatabla',$mezok,true)['sql'];