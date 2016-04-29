<?php
namespace lib\db;
define("_MOTTO", "igen");
//require 'vendor/autoload.php';
require_once 'G:\www\soctest\lib\db\db.php';
require_once 'G:\www\soctest\lib\db\dba.php';
class DBATest extends \PHPUnit_Framework_TestCase
{
    public  function test_beszur_postbol()
    {

        $mezok['egyes']=[];$mezok['kettes']=[];
        $return="INSERT INTO probatabla (egyes,kettes) VALUES ('','')";
        // $return2=\GOB::$db;
        $this->assertEquals(
            $return,
            DBA::beszur_postbol('probatabla',$mezok,true)['sql']

        );

echo DBA::beszur_postbol('probatabla',$mezok,true)['sql'];
    }
}
