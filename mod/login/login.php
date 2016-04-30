<?php
namespace mod\login;
defined( '_MOTTO' ) or die( 'Restricted access' );
//include_once 'mod/login/lt.php';
use lib\db\DB;
//use lib\ell;
use lib\ell;
use lib\ell\Ell;

class LogADT
{

    public static $view='';
    public static $hiba=true;
    public static $referer=true;
    public static $task_nev='ltask';
    public static $reg_form='mod/login/view/regisztral_form.html';
    public static $belep_form='mod/login/view/belep_form.html';
    public static $kilep_form='mod/login/view/kilep_form.html';
    public static $szerk_form='mod/login/view/szerk_form.html';
    public static $szerk_kesz_form='mod/login/view/szerk_kesz_form.html';

    		
}
class LogView
{
   public static function belep()
   {
      LogADT::$view= file_get_contents(LogADT::$belep_form, true);
   }
    public static function kilep(){
        LogADT::$view= file_get_contents(LogADT::$kilep_form, true);
    }
    public static function reg(){
        LogADT::$view= file_get_contents(LogADT::$reg_form, true);
        if(isset($_POST['ref'])){
            LogADT::$view = str_replace('<!--<h5>ref</h5>-->','<h5>Ref:'.$_POST['ref'].'</h5>', LogADT::$view);
            LogADT::$view = str_replace('data="ref"','value="'.$_POST['ref'].'"', LogADT::$view);
        }

    }
    public static function szerk(){
        LogADT::$view= file_get_contents(LogADT::$szerk_form, true);
    }
    public static function szerk_kesz(){
    LogADT::$view= file_get_contents(LogADT::$szerk_kesz_form, true);
}

}


class Login
{
    public function result()
    {
        $func='alap';
        if(isset($_POST['ltask'])){$func=$_POST['ltask'];}
        $this->$func();
        return LogADT::$view;
    }
    public function alap()
    {
        if ($_SESSION['userid'] > 0) {
            LogView::kilep();
        } else {
            LogView::belep();
            $hiba = LogDataS::hibakiir();
            LogADT::$view = str_replace('<!--<h5>hiba</h5>-->', $hiba, LogADT::$view);
        }
    }

    public function belep()
    {
            $this->alap();
    }

    public function kilep()
    {
       /* if(isset($_COOKIE['cook_sess_id']))
        {
        setcookie("cook_sess_id", "", time()-COOKIE_EXPIRE, COOKIE_PATH);
        }*/
        $_SESSION['userid'] = 0;
        $this->alap();
    }

    public function szerk()
    {
        LogView::szerk();
    }

    public function szerkment()
    {
        LogDataS::szerk_ment();
        if (empty(\GOB::$hiba['login'])) {
            LogView::szerk_kesz();
        } else {
            LogView::szerk();
            $hiba = LogDataS::hibakiir();
            LogADT::$view = str_replace('<!--<h5>hiba</h5>-->', $hiba, LogADT::$view);
        }
//print_r(\GOB::$hiba['login']);
    }

    public function reg()
    {
        $view = file_get_contents(LogADT::$reg_form, true);
        if (isset($_SESSION['ref'])) {
            $view = str_replace('<!--<h5>ref</h5>-->', 'Referencia:' . $_SESSION['ref'], $view);
            $view = str_replace('data="ref"', 'value="' . $_SESSION['ref'] . '"', $view);
        }

        LogADT::$view= $view;

    }

    public function ment()
    {

        if (LogDataS::ment()) {
            $this->alap();
        } else {
            $view = file_get_contents(LogADT::$reg_form, true);
            $hiba = LogDataS::hibakiir();
            $tartalom = str_replace('<!--<h5>hiba</h5>-->', $hiba, $view);
            LogADT::$view= $tartalom;
        }

    }

    public function cancel()
    {
        $this->alap();
    }
}
class LogEll{

	public static function 	passwdHasonlit($pwd1,$pwd2)
	{
	    if($pwd1!=$pwd2){\GOB::$pwd2['login'][]='';}
	    return $pwd1;
	}
	public static function usernev($usernev)
	{
	self::usernev_belep($usernev);
	self::marvan_user($usernev);
		return $usernev;
	}
	
	public static function usernev_belep($usernev)
	{
	Ell::regex($usernev, '/^([a-záéíóöőúüűA-ZÁÉÍÓÖŐÚÜŰ0-9.,?!]){6,20}$/siu',ModLT::$lang['usernamelong_err'],'login');
	Ell::regex($usernev,string::$regexT['HU_TOBB_SZO'],ModLT::$lang['spec_char_error'],'login');
	}
		
	public static function email($email)
	{
	Ell::regex($email,string::$regexT['MAIL'],ModLT::$lang['email_err'],'login');
	self::marvan_email($email);
;
	}
	public static function jelszo($jelszo)
	{
		string($jelszo, '/^([a-záéíóöőúüűA-ZÁÉÍÓÖŐÚÜŰ0-9.,?!]){6,20}$/siu',ModLT::$lang['pwdlong_err'],'login');
		return md5($jelszo);
	}
	
	public static function marvan_user($val)
	{
		if(marvan('username',$val))
		{
			\GOB::$hiba['login'][] = ModLT::$lang['username_have'];
		}
	}
	public static function marvan_email($val)
	{
		if(marvan('email',$val))
		{
			\GOB::$hiba['login'][] = ModLT::$lang['email_have'];
		}
	}
	
	public static function marvan($mezonev,$val,$tabla='userek')
	{
		$result=true;
		$sql = "SELECT " . $mezonev . " FROM  " . $tabla . " WHERE " . $mezonev . "='" . $val . "'";
        $marvan = DB::assoc_sor($sql);
        if (isset($marvan[$mezonev])) {  $result = false; }
	
		return $result;
	}
}

class LogDataS {
	public static function safePOST($val,$res='')
	{
		if(isset($_POST[$val])){$res=$_POST[$val];}
		return $res;
	}
	
    public static function ment()
    {
    	$res=true;$beirT=[];
    	\GOB::$hiba['login']=[];
        $beirT['password'] =LogEll::jelszo(self::safePOST('password') );
       	$beirT['username'] =LogEll::usernev(self::safePOST('username') );
       	$beirT['email'] =LogEll::email(self::safePOST('email') );
       	LogEll::passwdHasonlit($beirT['password'], md5(self::safePOST('password2')));
        
        if(empty(\GOB::$hiba['login']))
        {
            $beszurtid=DB::beszur_postbol(LogADT::$tablanev,$beirT);
            if($beszurtid==0)
            {
                \GOB::$hiba['login'][]=ModLT::$lang['dberror'];
                $res=false;
            }
        }else{$res=false;}
      return $res;
    }  
    public static function belep()
    {  
    	$result=true;
    	\GOB::$hiba['login']=[];
        $jelszo = LogEll::jelszo(self::safePOST('password') );
        $usernev =LogEll::usernev_belep(self::safePOST('username') );

        if(empty(\GOB::$hiba['login']))
        {
            $sql="SELECT id,password FROM userek WHERE username='".$usernev."' AND pub='0'";
            $dd=DB::assoc_sor($sql);
            if(!empty($dd))
            {    if($jelszo!=$dd['password'])
                {
                    \GOB::$hiba['login'][]=ModLT::$lang['login_data_nomatch'];

                }
                else
                {
                    $_SESSION['userid']=$dd['id'];
                   // echo $_SESSION['userid'];
                }
            }else{ $result=false;\GOB::$hiba['login'][]=ModLT::$lang['login_data_nomatch'];}
        }
        return $result;
    }
    public static function passwdchange()
    {
    	\GOB::$hiba['login']=[];
    
    	$res = true;
    	$old_jelszo  = LogEll::jelszo(self::safePOST('oldpass') );
    	$jelszo  = LogEll::jelszo(self::safePOST('password1') );
    	$jelszo2 = LogEll::jelszo(self::safePOST('password2') );
    	LogEll::passwdHasonlit($jelszo, $jelszo2);
    	
    	if ($old_jelszo != \GOB::$user['password']) {
    		\GOB::$hiba['login'][] = ModLT::$lang['oldpasswd_err'];
    		$res = false;
    	}

    	if (empty(\GOB::$hiba['login'])) {
    		DB::parancs("UPDATE userek SET password='".$jelszo."' WHERE id='".\GOB::$user['id']."'");;
    	}
    	return $res;
    
    }
    public static function usrnamechange()
    {
    	\GOB::$hiba['login']=[];
    	$res = true;
    	$username = LogEll::usernev(self::safePOST('oldpass'));
 
    	if (empty(\GOB::$hiba['login'])) {
    		DB::parancs("UPDATE userek SET username='".$username."' WHERE id='".\GOB::$user['id']."'");
    	}
    	return $res;
    }
     
    public static function hibakiir()
    {
        $result='';
        if(isset(\GOB::$hiba['login']))
        {
            foreach(\GOB::$hiba['login'] as $hiba)
            {
                $result.=$hiba.'</br>';
            }
        }
        return $result;
    }
 
}