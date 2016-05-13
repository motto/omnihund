<?php
namespace lib\db;
defined( '_MOTTO' ) or die( 'Restricted access' );
class DBA
{
	/**
	truev-al vagy false-al tér vissza a hibát \GOB::$hiba['pdo'][]-ba írja
	 */
    static public function parancs($sql)
    {
        if (\CONF::$sql_log != 'no') {
            \GOB::$log['sql'][] = $sql;
        }
        $result = true;
        try {
            $stmt = \GOB::$db->prepare($sql);
            $stmt->execute();
        } catch (PDOException $e) {
            \GOB::$hiba['pdo'][] = $e->getMessage();
            $result = false;
        }

        return $result;
    }
   /**
  a beszúrt id-el tér vissza a hibát \GOB::$hiba['pdo'][]-ba írja
    */
    static public function beszur($sql)
    {if(\CONF::$sql_log!='no'){\GOB::$log['sql'][]=$sql;}
        $result = 0;
        try {
            $stmt = \GOB::$db->prepare($sql);

            $stmt->execute();
            $result=\GOB::$db->lastInsertId();

        } catch (PDOException $e) {
            \GOB::$hiba['pdo'][] = $e->getMessage();
            //echo $e->getMessage();
        }
        return $result;
    }
// self::parancs()-ot használják--------------------- 
    static public function pub ($tabla,$id,$id_nev='id')
    {
        $sql="UPDATE $tabla SET pub='0' WHERE $id_nev='$id'";
        $res =self::parancs($sql);
        return $res;
    }
    static public function tobb_pub ($tabla,$id_tomb,$id_nev='id')
    {
        foreach($id_tomb as $id){self::pub($tabla,$id,$id_nev); }
    }
    static public function unpub ($tabla,$id,$id_nev='id')
    {
        $sql="UPDATE $tabla SET pub='1' WHERE $id_nev='$id'";
        $sth =self::parancs($sql);
        return $sth;
    }
    static public function tobb_unpub ($tabla,$id_tomb,$id_nev='id')
    {
        foreach($id_tomb as $id){self::unpub($tabla,$id,$id_nev); }
    }
    static public function del($tabla,$id,$id_nev='id')
    {
        $sql="DELETE FROM $tabla WHERE $id_nev = '".$id."'";
        $sth =self::parancs($sql);
        return $sth;
    }
    static public function tobb_del($tabla,$id_tomb,$id_nev='id')
    {
        foreach($id_tomb as $id){self::del($tabla,$id,$id_nev); }
    }  
    /**
     figyelem, nem ellenőriz!! A dataT végijárva ($mezonev=>$value) frissít. true-val vagy false-al tér vissza
     ($test=tue-nál az sql-el) A self::parancs()-al a GOB::$hiba['pdo']-ba írja a hibát
     */
    static public function frissit_tombbol($tabla,$id,$mezoT=array(),$test=false)
    {
    	$setek='';
    	foreach ($mezoT as $mezonev=>$value)
    	{
    		$setek = $setek . $mezonev . "='" . $value . "', ";
    	}
    	if($setek !='')
    	{
    		$setek2 = substr($setek, 0, -2);
    		$sql = "UPDATE $tabla SET $setek2 WHERE id='$id'";
    		if($test){$result =$sql; }
    		else{$result = self::parancs($sql);}
    	}
    	return $result;
    }    
//---------------------------------------------------------   
/**
figyelem, nem ellenőriz!! A dataT végijárva ($mezonev=>$value) beszúr és a beszúrtiddel visszatér.
ha $test=true akkor nem ír be csak az sql-el tér vissza 
 */
    static public function beszur_tombbol($tabla,$dataT,$test=false)
    {
    	$value_string='';$mezo_string='';
    	$result=0;
    
    	foreach ($dataT as $mezonev=>$value)
    	{
    		$mezo_string .=  $mezonev . ",";
    		$value_string .=  "'" . $value . "',";
    
    	}
    	if($mezo_string!='')
    	{
    		$mezo_string2=rtrim($mezo_string,',');
    		$value_string2=rtrim($value_string,',');
    		$sql="INSERT INTO $tabla ($mezo_string2) VALUES ($value_string2)";
    		//visszatérési érték----------------------------
    		if($test){$result=$sql;}
    		else{$result=DBA::beszur($sql);}
    	}
    	return $result;
    }
	static public function select_sql($tabla,$id,$mezok='*')
    {
        $sql="SELECT $mezok FROM $tabla WHERE id='$id'";
        return $sql;
    }

}