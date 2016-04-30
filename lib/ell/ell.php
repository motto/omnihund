<?php
namespace lib\ell;

class Ell
{  static public $param=['min'=>'1','max'=>'250'];
    static public $regexT=[
    		//nincs ellenőrizve------------
        'SZAM'=>'/^[-+]?(\d*[.])?\d+$/', //pozitív vagy negativ szám tizeds tört is lehet
        'SZAM_POZ'=>'/^(\d*[.])?\d+$/', //pozitív szám tizedes tört is lehet
        'EGESZ'=>'/^[-]?[\d ]+$/', //pozitív vagy negatív egész szám
        'EGESZ_POZ'=>'/^(\d*[.])?\d+$/', //pozitív egész zsám
        //text----------------------
        'ENG_SZO_KIS'=>'/^[a-z\d]+$/',  // 1 ha csak angol kisbetű és szám van benne szóköz sem lehet
        'ENG_SZO'=>'/^[a-zA-Z\d]+$/',  // 1 ha csak angol kis és nagybetű és szám van benne szóköz sem lehet
        'ENG_TOBB_SZO'=>'/^[a-zA-Z\d ]+$/',  //csak angol kis és nagybetű szám és szóköz van
        'ENG_TEXT'=>'/^[a-zA-Z\d \!\"\?\.\:\(\)]+$/',//1 ha csak angol kis és nagybetű és szám szóköz és !?().:
    	'MIN_MAX_UJ' =>'/^([a-záéíóöőúüűA-ZÁÉÍÓÖŐÚÜŰ0-9.,?!]){<<min>>,<<max>>}$/siu',
        'MIN'=>'/^.{<<min>>,}$/',
        'MAX'=>'/^.{1,<<max>>}$/',
        'HU_SZO'=>'/^[a-zA-Z\déáűúőóüöÁÉŰÚŐÓÜÖ]+$/',  // eng_szo plusz ékezetesek
        'HU_TOBB_SZO'=>'/^[a-zA-Z\d éáűúőóüöÁÉŰÚŐÓÜÖ]+$/', //eng_tobb_szo plusz ékezetesek
        
         'MAIL'=>'/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/',//1 ha email
    //tesztelve---------------     
   //tagado 1 (true) az értéke ha megfelel a mintának, hogy a hiba legyen tagadni kell(!preg_match();)
    	 'MIN_MAX'=>'/^.{<<min>>,<<max>>}$/',//magyar karaktereket nem veszi figyelembe
    	'MIN_MAX_UJ'=>'/^.{<<min>>,<<max>>}$/u',//magyar karaktereket is figylembe veszi
    	'MIN6_MAX20'=>'/^.{6,20}$/',//jelszónál pl
    	'MAIL'=>'/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/',//1 ha email
    	'HU_TEXT'=>'/^[a-zA-Z\d \!\"\?\.\:\(\)éáűúőóüöÁÉŰÚŐÓÜÖ]+$/',//ures stringnél is hibát jelez!!!
    	//'MIN_MAX_UJ' =>'/^([a-záéíóöőúüűA-ZÁÉÍÓÖŐÚÜŰ0-9.,?!]){<<min>>,<<max>>}$/siu',
        //kereso------------------------
        'DIV'=>'#<div[^>]*>(.*?)</div>#', //le kell ellenőrizni
    	'DIV_CLASS'=>'/<div class=\"main\">([^`]*?)<\/div>/'	
    ];
    
 static public function regex($text, $reg_ex,$hiba='regexhiba',$hibamezo='ell')
  {
  if (!preg_match($reg_ex,$text)){\GOB::$hiba[$hibamezo][] =$hiba;}
  return $text;
  }
  
  static public function tartalmak_divekebn($text){
  	return self::kigyujt(self::$regexT['DIV'], $text)	;
  }
  
  static public function kigyujt($regx,$text){
  	$matches=[];
  	preg_match_all ($reg, $text, $matches);
  	return $matches;
 
  }
  
  
}