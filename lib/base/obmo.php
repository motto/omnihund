<?php
namespace lib\base;
defined( '_MOTTO' ) or die( 'Restricted access' );
interface IObMo{
	
	function __construct($parT=[]);
	public function initMo($parT = []);
	public function frissit($parT=[]);
	public function __toString();
}

class ObMo implements IObMo 
{

    function __construct($parT=[])
    {
        $this->initMo($parT);

    }
    public function frissit($parT=[]){
    	 $this->initMo($parT);
    	return  $this->__toString($parT);
    }
    
    public function initMo($parT = []){

        foreach ($parT as $name => $value)
        {
            if(isset($this->$name)){$this->$name=$value;}
        }
    }
    
   
    public function __toString(){}


}
class ObMo_St extends ObMo
{
	
 public static function res($parT=[]){
 	//$ob= new ItemView($parT=[]);
	//	return $ob->__toString()
 }	
}

