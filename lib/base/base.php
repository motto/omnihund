<?php
namespace lib\base;
class Base
{
/**
 *Paramétere álltalában az eredeti GOB::Lang visszatérési értéke 
előbb a böngészőtől kéri le az alapértelmezett nyelvet majd a 'SESSION','POST','GET' ben ellenőrzi 
ha valamelyikben az adott érték és szerepel a CONF::$accepted_langT-ben azzal tér vissza
 */
public static function setlang($lang)
{
 if(isset($_SERVER['HTTP_ACCEPT_LANGUAGE']))
 {
     $brow=substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
     if(in_array($brow,\CONF::$accepted_langT)){$lang=$brow ;}
 }
 if(isset($_SESSION['lang']) && in_array($_SESSION['lang'],\CONF::$accepted_langT)){$lang=$_SESSION['lang'];}
 if(isset($_POST['lang']) && in_array($_POST['lang'],\CONF::$accepted_langT)){$lang=$_POST['lang'];}
 if(isset($_GET['lang']) && in_array($_GET['lang'],\CONF::$accepted_langT)){$lang=$_GET['lang'];}
    $_SESSION['lang']=$lang;
    return $lang;
}
/**
*Az adott sorrendben (alapértelmezett:'SESSION','POST','GET')megnézi hogy a $key kulcs létezik-e
* ha igen  azzzal felülírja a $def-et ha nem a def változóval tér vissza
* tehát ha mindegyikben létezik akkor az utolsó (alapesetben:GET) lesz a visszatérési érték.
*/
public static function setGlob($key,$def='',$sorrend=['SESSION','POST','GET'])
{
	foreach ($sorrend as $sor){
		
		eval('if(isset($_'.$sor.'[\''.$key.'\'])){$def=$_'.$sor.'[\''.$key.'\'];}');
	}
	return $def;
}
/**
tömb $key rtékével tér vissza ha létezik vagy a$ def-el
 */
static public function safeTval($arr=[],$key='',$def='')
    {
        if (isset($arr[$key]))
        {
            return $arr[$key];
        } else
        {
            return $def;
        }
    }

}
