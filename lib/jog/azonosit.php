<?php
namespace lib\jog;
use lib\db\DB;
use mod\login\LogDataS;

/**
 * Class Azonosit
 * session-be írja az useridet vagy nullát
 */
class Azonosit
{
    function __construct()
    {
        $this->alap();
    }

    function alap()
    {
        if(!isset($_SESSION['userid'])) {$_SESSION['userid']=0;}

    }
    public static function set_userdata($userid,$mezok='id,username,email,password')
    {
        if($mezok=='') {$mezok=\GOB::$user_mezok;}
        $sql="SELECT ".$mezok." FROM userek WHERE id='".$userid."'";
        $userT= DB::assoc_sor($sql);
        if(empty($userT)){\GOB::$hiba['userdata'][]='Az useradat lekérdezés üres tömböt adott vissza. SQL='.$sql;}
        return $userT;
    }


}