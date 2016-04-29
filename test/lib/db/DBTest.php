<?php
namespace lib\db;
define("_MOTTO", "igen");
//require 'G:\www\soctest\vendor\autoload.php';
require_once 'G:\www\soctest\lib\db\db.php';
require_once 'G:\www\soctest\def.php';
class DBTest extends \PHPUnit_Framework_TestCase
{

    public  function testconnect()
    {
       \CONF::$adatbazis='test';
        $return=true;
        $return2=\GOB::$db;
       $this->assertEquals(
            $return,
            DB::connect()

        );
        $this->assertNotEquals(
            $return2,
           \GOB::$db

        );

    }
    public  function testparancs()
    {
        \CONF::$adatbazis='test'; DB::connect();

        $return=true;
        $return2=\GOB::$db;
        $this->assertEquals(
            $return,
            DB::connect()

        );
        $this->assertNotEquals(
            $return2,
            \GOB::$db

        );

    }
}
