<?php


trait trait1 {
 public function res(){echo 'trait1';}
    public static function res_futtat_stat(){echo 'futtatot res';self::res(); }
}
trait trait2 {
	public function res(){echo 'trait2';}
	public static function res_futtat_stat(){echo 'futtatot res';self::res(); }
}

$tr='trait2';
$xx=<<<ppp
class  traitproba{

use $tr;	
	public static function fut(){
	
		self::res(); }
}

ppp;

eval($xx);


traitproba::res_futtat_stat();
traitproba::res();
